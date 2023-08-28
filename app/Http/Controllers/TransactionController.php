<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;
use App\Models\Product;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        $transaction = 1;
        return view('admin.transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userdata = Auth::user();
        $no_invoice = "INV".$userdata->id.$userdata->employee_id.strtotime(date('YmdHis'));
        return view('admin.transaction.create', compact('no_invoice'));
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
            $vat_amount = config('app.vat_amount');
            $vat_price  = $sub_price * ($sub_price / 100);
            $total_price = $sub_price + $vat_price;

            $transaction = Transaction::create([
                'emp_no'        => Auth::user()->employee_id,
                'invoice_no'    => $request->invoice_no,
                'receipt_no'    => $receipt_no,
                'trans_date'    => date('Y-m-d'),
                'payment_method'    => $request->payment_method,
                'cash'          => str_replace(".", "", $request->cash),
                'sub_price'     => $sub_price,
                'vat_ppn'       => $vat_amount,
                'total_price'   => $total_price,
                'status'        => "FINISH"
            ]);
            // dd($transaction, $transaction_details);
            
            if ($transaction) {
                foreach ($transaction_details as $v) {
                    $code   = $v['product_code'];
                    $qty    = $v['quantity'];
                    // Update amount
                    $product = Product::where('code', $code)->first();
                    $product->stock = $product->stock - $qty;
                    $product->save();
                }
                $trans_detail_insert = DB::table('tr_transaction_detail')->insert($transaction_details);
            }

            Alert::success('Add Transaction', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('transaction.index');
    }

    public function print_receipt() {
        return view('admin.transaction.receipt');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
   

    public function edit(Transaction $transaction)
    {
        return view('admin.transaction.edit');
    }

    public function edit_template()
    {
        return view('admin.transaction.edit');
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
