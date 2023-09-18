<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use App\Models\Membership;
use Session;
use App\Models\User;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:T Show', ['only' => ['index', 'summary_cashier']]);
        $this->middleware('permission:T Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:T Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:T Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $transactions = [];
        $query = Transaction::where('trans_date', date('Y-m-d'))->orderBy('id', 'desc')->with(['user']);
        if ($request->get('keyword')) {
            $query->where('invoice_no', $request->keyword);
        }
        if ($user->roles->first()->name == 'Cashier') {
            $query->where('emp_no', $user->employee_id);
        }
        $transactions = $query->paginate(9);
        // $session_user = Auth::user()->roles()->first()->name;
        // dd($transaction);
        // dd($session_user);
        return view('admin.transaction.index', compact('transactions'));
    }

    public function index_draft(Request $request)
    {
        $user = Auth::user();

        $query = Transaction::where('trans_date', date('Y-m-d'))->where('status', 'DRAFT')->where('emp_no', $user->employee_id)->with(['user'])->orderBy('id', 'desc');
        if ($request->get('keyword')) {
            $query->where('invoice_no', $request->keyword);
        }
        $transactions = $query->paginate(10);
        // $session_user = Auth::user()->roles()->first()->name;
        // dd($transaction);
        // dd($session_user);
        return view('admin.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userdata = Auth::user();
        // $session_user = $request->session()->get('role');
        $product_discount = Product::select('code', 'name', 'price_store', 'discount_store')->where('discount_store', '>', 0)->get();
        $no_invoice = "INV".$userdata->id.$userdata->employee_id.strtotime(date('YmdHis'));
        $memberships = Membership::all();
        // if (Session::get('receipt')) {
        //     dd(Session::get('receipt'));
        // }
        // dd($session_user);
        return view('admin.transaction.create', compact('no_invoice', 'product_discount', 'memberships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_no' => 'required|string|unique:tr_transaction,invoice_no',
            'payment_method' => 'required',
        ]);

        $receipt_no = $request->payment_method == 'Tunai' ? rand(10000000, 99999999) : $request->receipt_no;
        $product_code       = $request->product_code;
        if (empty($product_code)) {
            return redirect()->back()->withInput($request->all())->withErrors("No product chosen!");
        }
        $basic_price  = $request->basic_price;
        $discount     = $request->discount_store;
        $quantity     = $request->quantity;
        $final_price  = $request->final_price;
        $status  = $request->status;
        // dd($request->all());
        DB::beginTransaction();
        try {
            
            $transaction_details = [];
            $sub_price = 0;
            foreach ($product_code as $i => $v) {
                $trans_detail = [
                    "invoice_no"    => $request->invoice_no,
                    "product_code"  => $v,
                    "quantity"      => $quantity[$i],
                    "basic_price"   => $basic_price[$i],
                    "discount"      => $discount[$i],
                    "price"         => $final_price[$i],
                ];
                $transaction_details[] = $trans_detail;
                $sub_price += $final_price[$i];
            }
            $cash = !empty($request->cash) ? str_replace(".", "", $request->cash) : 0;
            $total_price = $sub_price;
            $vat_amount = 0;
            // $vat_amount = config('app.vat_amount');
            // $vat_price  = ($sub_price / 100) * $vat_amount;
            // $total_price = $sub_price + $vat_price;
            $kembalian = $request->payment_method == 'Tunai' && $status == 'FINISH' ? $cash - $total_price : 0;

            if ($status == 'FINISH' && $request->payment_method == 'Tunai' && $cash < $total_price) {
                return redirect()->back()->withInput($request->all())->withErrors("Cash less than total transaction!");
            }

            $trans = [
                "membership_id"   => $request->membership_id,
                'emp_no'        => Auth::user()->employee_id,
                'invoice_no'    => $request->invoice_no,
                'receipt_no'    => $receipt_no,
                'trans_date'    => date('Y-m-d'),
                'payment_method'    => $request->payment_method,
                'cash'          => str_replace(".", "", $request->cash),
                'sub_price'     => $sub_price,
                'vat_ppn'       => $vat_amount,
                'total_price'   => $total_price,
                'status'        => $status,
                'kembalian'     => str_replace(".", "", $request->kembalian)
            ];
            $transaction = Transaction::create($trans);
            
            if ($transaction) {
                foreach ($transaction_details as $v) {
                    $code   = $v['product_code'];
                    $qty    = $v['quantity'];
                    if ($status == "FINISH") {
                        // Update amount
                        $product = Product::where('code', $code)->first();
                        $product->stock = $product->stock - $qty;
                        $product->save();
                    }
                }
                $trans_detail_insert = DB::table('tr_transaction_detail')->insert($transaction_details);
            }

            Alert::success('Add Transaction', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        } finally {
            DB::commit();
        }
        if ($status == "DRAFT") {
            return redirect()->back();
        }
        return redirect()->route('transaction.receipt', $request->invoice_no);
    }

    public function print_receipt(Transaction $transaction) {
        // $shark = Transaction::find($transaction);
        // dd($shark);
        // return view('admin.transaction.receipt', compact('transaction'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction = Transaction::with(['user'])->where('tr_transaction.invoice_no', $transaction->invoice_no)->first();
        $details = TransactionDetail::select('tr_transaction_detail.*', 'products.name' , 'products.code')->where('invoice_no', $transaction->invoice_no)->join('products', 'tr_transaction_detail.product_code', 'products.code')->get();
        $data = [
            "transaction"   => $transaction,
            "details" => $details
        ];
        return response()->json($data);

    }

    public function receipt(Transaction $transaction)
    {
        // $transaction = Transaction::with(['user', 'membership'])->where('tr_transaction.invoice_no', $transaction->invoice_no)->first();
        $details = TransactionDetail::select('tr_transaction_detail.*', 'products.name' , 'products.code')->where('invoice_no', $transaction->invoice_no)->join('products', 'tr_transaction_detail.product_code', 'products.code')->get();
        // dd($details);
        return view('admin.transaction.query', compact('transaction', 'details'));
    }

    public function query(Transaction $transaction)
    {
        $transaction = Transaction::with(['user'])->where('tr_transaction.invoice_no', $transaction->invoice_no)->first();
        $transaction_details = TransactionDetail::select('tr_transaction_detail.*', 'products.name' , 'products.code')->where('invoice_no', $transaction->invoice_no)->join('products', 'tr_transaction_detail.product_code', 'products.code')->get();
        // dd($transaction_details);
        return view('admin.transaction.query', compact('transaction', 'transaction_details'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
   

    public function edit(Transaction $transaction)
    {
        $user = Auth::user();
        if ($user->employee_id != $transaction->emp_no) {
            // return redirect()->back()->withErrors("You dont have permission to draft this transaction!");
        }
        // dd($transaction, $user);
        $transaction_details = TransactionDetail::select('product_code', 'invoice_no', 'quantity')->where('invoice_no', $transaction->invoice_no)->get();
        $product_discount = Product::select('code', 'name', 'price_store', 'discount_store')->where('discount_store', '>', 0)->get();
        return view('admin.transaction.edit', compact('transaction', 'transaction_details', 'product_discount'));
    }

    public function summary(Transaction $transaction) {
        return view('admin.transaction.summary');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
        $request->validate([
            'invoice_no' => 'required|string',
            'payment_method' => 'required',
        ]);

        $receipt_no = $request->payment_method == 'Tunai' ? rand(10000000, 99999999) : $request->receipt_no;
        $product_code       = $request->product_code;
        if (empty($product_code)) {
            return redirect()->back()->withInput($request->all())->withErrors("No product chosen!");
        }
        $basic_price  = $request->basic_price;
        $discount     = $request->discount_store;
        $quantity     = $request->quantity;
        $final_price  = $request->final_price;
        $status         = $request->status;
        
        DB::beginTransaction();
        try {
            
            $transaction_details = [];
            $sub_price = 0;
            foreach ($product_code as $i => $v) {
                $trans_detail = [
                    "invoice_no"    => $request->invoice_no,
                    "product_code"  => $v,
                    "quantity"      => $quantity[$i],
                    "basic_price"   => $basic_price[$i],
                    "discount"      => $discount[$i],
                    "price"         => $final_price[$i],
                ];
                $transaction_details[] = $trans_detail;
                $sub_price += $final_price[$i];
            }
            $cash = !empty($request->cash) ? str_replace(".", "", $request->cash) : 0;
            $total_price = $sub_price;
            $vat_amount = 0;
            // $vat_amount = config('app.vat_amount');
            // $vat_price  = ($sub_price / 100) * $vat_amount;
            // $total_price = $sub_price + $vat_price;
            $kembalian = $request->payment_method == 'Tunai' && $status == 'FINISH' ? $cash - $total_price : 0;
            if ($request->payment_method == 'Tunai' && $cash < $total_price) {
                return redirect()->back()->withInput($request->all())->withErrors("Cash less than total transaction!");
            }

            $trans = [
                'receipt_no'    => $receipt_no,
                'payment_method'    => $request->payment_method,
                'cash'          => $cash,
                'sub_price'     => $sub_price,
                'vat_ppn'       => $vat_amount,
                'total_price'   => $total_price,
                'status'        => $status,
                'kembalian'        => $kembalian
            ];
            // dd($transaction, $transaction_details);
            $transaction_update = Transaction::find($transaction->id)->update($trans);
            
            
            if ($transaction_update) {
                //  CLEAR DETAIL
                DB::table('tr_transaction_detail')->where('invoice_no', $transaction->invoice_no)->delete();
                // RE-INSERT PRODUCT
                foreach ($transaction_details as $v) {
                    $code   = $v['product_code'];
                    $qty    = $v['quantity'];
                    if ($status == "FINISH") {
                        // Update amount
                        $product = Product::where('code', $code)->first();
                        $product->stock = $product->stock - $qty;
                        $product->save();
                    }
                }
                $trans_detail_insert = DB::table('tr_transaction_detail')->insert($transaction_details);
            }

            Alert::success('Add Transaction', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        } finally {
            DB::commit();
        }
        return redirect()->route('transaction.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction, Request $request)
    {
        $reason = $request->del_reason;
        $emp_appr = $request->del_emp_appr;

        $invoice_no = $transaction->invoice_no;
        $trans_detail = DB::table('tr_transaction_detail')->where('invoice_no', $invoice_no)->get();
        $transaction = (array) $transaction;
        unset($transaction['id']);
        $transaction_details = [];
        foreach ($trans_detail as $v) {
            $td = (array) $v;
            unset($td['id']);
            $transaction_details[] = $td;
        }

        $transaction['del_by'] = Auth::user()->employee_id;
        $transaction['del_at'] = date('Y-m-d H:i:s');
        $transaction['del_reason'] = $reason;
        $transaction['del_emp_appr'] = $emp_appr;
        
        DB::table('tr_transaction_log')->insert($transaction);
        DB::table('tr_transaction_detail_log')->insert($transaction_details);

        DB::table('tr_transaction')->where('invoice_no', $invoice_no)->delete();
        DB::table('tr_transaction_detail')->where('invoice_no', $invoice_no)->delete();
        
        return redirect()->route('transaction.create');
    }

    public function add_member(Request $request)
    {
        $return_data = [
            "status"    => "failed",
            "message"   => "",
            "data"      => []
        ];
        $check_existing = Membership::where('code', $request->code)->orWhere('phone', $request->phone)->orWhere('email', $request->email)->first();
        if (!empty($check_existing)) {
            $return_data["message"] = "Code / Phone Number / Email already used!";
        } else {
            $membership = Membership::create([
                'code' => $request->code,
                'name' => $request->name,
                'phone' => $request->phone,
                'email'   => $request->email,
            ]);
            $return_data["status"] = "success";
            $return_data["message"] = "Success!";
            $return_data["data"] = $membership;
        }

        

        return response()->json($return_data);
    }

    public function check_pin(Request $request)
    {
        $user = [];
        if ($request->has('pin')) {
            $user = User::select('employee_id', 'name', 'pin')->where('pin', $request->pin)->first();
        }

        return response()->json($user);
    }
}
