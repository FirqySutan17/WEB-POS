<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Receive;
use App\Models\ReceiveDetail;
use App\Models\Product;

class ReceiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:R Show', ['only' => 'index']);
        $this->middleware('permission:R Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:R Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:R Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $receives = [];
        if ($request->get('keyword')) {
            $receives = Receive::search($request->keyword)->orderBy('id', 'desc')->paginate(9);
        } else {
            $receives = Receive::orderBy('id', 'desc')->paginate(9);
        }
        // dd($receives);
        return view('admin.receive.index', [
            'receives' => $receives
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = DB::table('suppliers')->orderBy('supplier_code', 'ASC')->get();
        return view('admin.receive.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'receive_date' => 'required',
            'receive_time' => 'required',
            'delivery_number' => 'required|string',
            // 'delivery_file' => 'required'
        ]);

        if (empty($request->product_code)) {
            return redirect()->back()->withInput($request->all())->withErrors("Tidak ada product yang dipilih");
        }

        DB::beginTransaction();
        try {
            $receive_code = "RCV".date("YmdHis");
            $supplier_code = $request->is_warehouse == 1 ? NULL : $request->supplier_code;
            $insertdata = [
                'receive_code'  => $receive_code,
                'receive_date'  => $request->receive_date,
                'receive_time'  => $request->receive_time,
                'driver'        => $request->driver,
                'driver_phone'  => $request->driver_phone,
                'plate_no'       => $request->plate_no,
                'delivery_no'   => $request->delivery_number,
                'is_warehouse'   => $request->is_warehouse,
                'supplier_code'   => $supplier_code,
            ];
            // dd($insertdata, $request->all());
            $receive = Receive::create($insertdata);

            if ($request->file('delivery_file')) {
                $file = $request->file('delivery_file');
                $original_name = $file->getClientOriginalName();
                $ext = pathinfo($original_name, PATHINFO_EXTENSION);
                $namefile = "delivery_".$receive_code.".".$ext;

                $file->move('file_upload', $namefile);
                $receive->delivery_file = $namefile;
                $receive->save();
            }

            $product_code   = $request->product_code;
            $quantity       = $request->quantity;
            $unit_price       = $request->unit_price;
            $amount         = $request->amount;
            $product_arr    = [];
            if (!empty($receive) && !empty($product_code)) {
                foreach ($product_code as $key => $v) {
                    $qty = $quantity[$key];
                    $up     = $unit_price[$key];
                    $amt    = $amount[$key];
                    $product_arr[] = [
                        'receive_code'  => $receive_code,
                        'product_code'  => $v,
                        'quantity'        => $qty,
                        'unit_price'        => $up,
                        'amount'        => $amt
                    ];

                    // Update amount
                    $product = Product::where('code', $v)->first();
                    $product->stock = $product->stock + $qty;
                    $product->save();
                }

                DB::table('tr_receive_detail')->insert($product_arr);
            }
            Alert::success('Add Receive', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('receive.index');
    }

    public function show($receive)
    {
        $receive = Receive::with('user')->where('receive_code', $receive)->first();
        $receive->created_at = date('Y-m-d H:i:s', strtotime($receive->created_at));
        // dd($receive_data);
        $details = ReceiveDetail::select('tr_receive_detail.*', 'products.name' , 'products.code')->where('receive_code', $receive->receive_code)->join('products', 'tr_receive_detail.product_code', 'products.code')->get();
        $data = [
            "receive"   => $receive,
            "details" => $details
        ];
        return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        try {
            $portfolio->delete();
            Alert::success('Delete Portfolio', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Portfolio', 'Error' . $th->getMessage());
        }
        return redirect()->back();
    }

    private function statuses()
    {
        return [
            '0' => 'Draft',
            '1' => 'Published',
        ];
    }
}
