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
        $transactions = [];
        if ($request->get('keyword')) {
            $transactions = Transaction::search($request->keyword)->with(['detail', 'user'])->orderBy('id', 'desc')->paginate(9);
        } else {
            $transactions = Transaction::orderBy('id', 'desc')->with(['detail', 'user'])->paginate(9);
        }
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
        // dd($session_user);
        return view('admin.transaction.create', compact('no_invoice', 'product_discount'));
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
            $vat_amount = config('app.vat_amount');
            $vat_price  = ($sub_price / 100) * $vat_amount;
            $total_price = $sub_price + $vat_price;

            if ($status == 'FINISH' && $request->payment_method == 'Tunai' && $cash < $total_price) {
                return redirect()->back()->withInput($request->all())->withErrors("Cash less than total transaction!");
            }

            $trans = [
                'emp_no'        => Auth::user()->employee_id,
                'invoice_no'    => $request->invoice_no,
                'receipt_no'    => $receipt_no,
                'trans_date'    => date('Y-m-d'),
                'payment_method'    => $request->payment_method,
                'cash'          => $cash,
                'sub_price'     => $sub_price,
                'vat_ppn'       => $vat_amount,
                'total_price'   => $total_price,
                'status'        => $status
            ];
            $transaction = Transaction::create($trans);
            // dd($transaction, $transaction_details);
            
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
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('transaction.create');
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
        $transaction = Transaction::find($transaction);

        $details = TransactionDetail::where('invoice_no', $transaction[0]->invoice_no)->join('products', 'tr_transaction_detail.product_code', 'products.code')->get();
        // dd($details);
        return view('admin.transaction.receipt', compact('transaction', 'details'));
    }

    public function receipt(Transaction $transaction)
    {
        $transaction = Transaction::find($transaction);

        $details = TransactionDetail::where('invoice_no', $transaction[0]->invoice_no)->join('products', 'tr_transaction_detail.product_code', 'products.code')->get();
        // dd($details);
        return view('admin.transaction.receipt', compact('transaction', 'details'));
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
            $vat_amount = config('app.vat_amount');
            $vat_price  = ($sub_price / 100) * $vat_amount;
            $total_price = $sub_price + $vat_price;
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
                'status'        => $status
            ];
            $transaction_update = Transaction::find($transaction->id)->update($trans);
            // dd($transaction, $transaction_details);
            
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
    public function destroy(Transaction $transaction)
    {
        //
    }
}
