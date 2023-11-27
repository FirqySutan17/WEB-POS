<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\CommonCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $purchaseOrders = [];
        if ($request->get('keyword')) {
            $purchaseOrders = PurchaseOrder::orderBy('id', 'desc')->paginate(9);
        } else {
            $purchaseOrders = PurchaseOrder::orderBy('id', 'desc')->paginate(9);
        }
        // dd($purchaseOrders);
        return view('admin.purchase-order.index', [
            'purchaseOrders' => $purchaseOrders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataPlant = $this->dataPlant();
        $commons = CommonCode::all();
        return view('admin.purchase-order.create', compact('commons', 'dataPlant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $po_no      = $this->generatePONo();
        $plant      = $request->plant;
        $date_po    = $request->date_po;
        $time_po    = $request->time_po;
        $supplier_id  = $request->supplier_id;
        $top_days  = $request->top_days;
        $top_category  = $request->top_category;
        $top_date  = $request->top_date;
        $delivery_time  = $request->delivery_time;
        $delivery_place  = $request->delivery_place;
        $remarks  = $request->remarks;
        $is_tax  = $request->is_tax == "no" ? 0 : 1;
        $is_po  = $request->is_po == "no" ? 0 : 1;

        DB::beginTransaction();
        try {
            
            $po_details = [];
            $sub_price = 0;
            $product_code   = $request->product_code;
            $quantity       = $request->quantity;
            $unit_price     = $request->unit_price;

            $grand_qty          = 0;
            $grand_amount       = 0;
            $grand_total_tax    = 0;
            $grand_total_amount = 0;
            $po_data = [];

            foreach ($product_code as $i => $v) {
                $amount = $unit_price[$i] * $quantity[$i];
                $tax    = 0;
                $trans_detail = [
                    "no_po"         => $po_no,
                    "product_code"  => $v,
                    "qty"           => $quantity[$i],
                    "unit_price"    => $unit_price[$i],
                    "amount"        => $amount,
                    "tax_amount"    => $tax,
                    "total_amount"    => $amount,
                ];
                $po_details[] = $trans_detail;
                $grand_qty += $quantity[$i];
                $grand_amount += $amount;
                $grand_total_tax += $tax;
                $grand_total_amount = $amount + $tax;
            }

            $po = [
                'plant'    => $plant,
                'no_po'    => $po_no,
                'date_po'          => $date_po,
                'time_po'     => $time_po,
                'supplier_id'       => $supplier_id,
                'top_days'   => $top_days,
                'top_category'        => $top_category,
                'top_date'        => $top_date,
                'delivery_time'        => $delivery_time,
                'delivery_place'        => $delivery_place,
                'remarks'        => $remarks,
                'is_tax'        => $is_tax,
                'is_po'        => $is_po,
                'grand_qty'        => $grand_qty,
                'grand_amount'        => $grand_amount,
                'grand_total_tax'        => $grand_total_tax,
                'grand_total_amount'        => $grand_total_amount
            ];
            $po_insert = PurchaseOrder::create($po);
            
            if ($po_details) {
                $po_detail_insert = DB::table('mst_tbl_po_detail')->insert($po_details);
            }

            Alert::success('Add PO', 'Success');
            // dd($request->all());
            return redirect()->route('purchase-order');
        } catch (\Throwable $th) {
            dd($th->getMessage(), $request->all());
            DB::rollBack();
        } finally {
            DB::commit();
        }
        return redirect()->route('purchase-order.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $dataPlant = $this->dataPlant();
        $commons = CommonCode::all();
        return view('admin.purchase-order.edit', compact('commons', 'dataPlant', 'purchaseOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    private function dataPlant() {
        return ["Jakarta - PT. Feed & Care Indonesia", "Semarang - PT. Feed & Care Indonesia", "Lampung - PT. Feed & Care Indonesia"];
    }

    private function generatePONo() {
        $no_po = date('Ymd')."PO";
        $no = 1;
        $today = date('Y-m-d');
        $latest_po = PurchaseOrder::whereDate('date_po', $today)->orderBy('id', 'DESC')->first();
        if (!empty($latest_po)) {
            $no = substr($latest_po->no_po, -4);

            $date = date('Y-m-d', strtotime($latest_po->created_at));
            $hour = date('H', strtotime($latest_po->created_at));
            $no += 1;
        }

        if ($no < 10) {
            $no = "000".$no;
        } elseif ($no >= 10 && $no < 100) {
            $no = "00".$no;
        } elseif ($no >= 100 && $no < 1000) {
            $no = "0".$no;
        }

        $no_po = $no_po.$no;
        return $no_po;
    }
}
