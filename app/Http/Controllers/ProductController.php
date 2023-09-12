<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Product;
use App\Models\ProductPriceLog;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:P Show', ['only' => 'index']);
        $this->middleware('permission:P Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:P Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:P Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = [];
        if ($request->get('keyword')) {
            $products = Product::search($request->keyword)->orderBy('stock', 'asc')->orderBy('id', 'desc')->paginate(9);
        } else {
            $products = Product::orderBy('stock', 'asc')->orderBy('id', 'desc')->paginate(9);
        }
        // dd($products);
        return view('admin.product.index', [
            'products' => $products
        ]);
    }


    public function select(Request $request)
    {
        $products = [];
        if ($request->has('q')) {
            $products = Product::select('code', 'name')->where('code', 'LIKE', $request->q.'%')->orWhere('name', 'LIKE', $request->q.'%')->get();
        }

        return response()->json($products);
    }

    public function select_one(Request $request)
    {
        $product_code = $request->product_code;
        $result = [
            "status"    => "failed",
            "message"   => "Product not found",
            "data"      => []
        ];
        if (!empty($product_code)) {
            $products = Product::select('id', 'code', 'name', 'price_store', 'discount_store', 'stock', 'is_vat')->where('code', $product_code)->first();
            if (!empty($products)) {
                $result["message"]  = "";
                $result["status"]   = "success";
                $result["data"]     = $products;
                // if ($products->stock < 1) {
                //     $result["message"]  = "Empty stock!";
                //     $result["status"]   = "failed";
                //     $result["data"]     = [];
                // }

                if ($products->is_vat == 1) {
                    $vat_percent    = config('app.vat_amount');
                    $vat_amount     = ($products->price_store / 100) * $vat_percent;
                    $products->price_store = $products->price_store + $vat_amount;
                }
            }
        }

        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
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
            'name' => 'required',
            'code' => 'required|string|unique:products,code',
            'price_store' => 'required|string',
            'price_olshop' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name' => $request->name,
                'code' => $request->code,
                'price_store' => $request->price_store,
                'price_olshop' => $request->price_olshop,
                'discount_store' => $request->discount_store,
                'discount_olshop' => $request->discount_olshop,
                'description'   => $request->description,
                'stock'   => 0,
                'is_active' => ($request->is_active) ? '1' : '0',
                'is_vat' => ($request->is_vat) ? '1' : '0',
            ]);

            if ($product) {
                $this->insert_price_logs($product);
            }

            Alert::success('Add Product', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $price_logs = ProductPriceLog::where('product_code', $product->code)->orderBy('id', 'DESC')->get();
        return view('admin.product.detail', compact('product', 'price_logs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $statuses = $this->statuses();

        return view('admin.product.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'code' => 'required|string|unique:products,code' .  $product->id,
                'price_store' => 'required|string',
                'price_olshop' => 'required'
            ],
            [],
        );

        DB::beginTransaction();
        try {
            $update_data = [
                'name' => $request->name,
                'price_store' => $request->price_store,
                'price_olshop' => $request->price_olshop,
                'discount_store' => $request->discount_store,
                'discount_olshop' => $request->discount_olshop,
                'description'   => $request->description,
                'is_active' => ($request->is_active) ? '1' : '0',
            ];

            $update= DB::table('products')->where('id', $product->id)->update($update_data);
            $check_price_logs = ProductPriceLog::where('product_code')->first();

            $product->price_store       = $request->price_store;
            $product->price_olshop      = $request->price_olshop;
            $product->discount_store    = $request->discount_store;
            $product->discount_olshop   = $request->discount_olshop;
            if (empty($check_price_logs)) {
                $this->insert_price_logs($product);
            } elseif ($product->price_store != $request->price_store || $product->price_olshop != $request->price_olshop || $product->discount_store != $request->discount_store || $product->discount_olshop != $request->discount_olshop || $product->is_vat != $request->is_vat) {
                $this->insert_price_logs($product);
            }

            Alert::success('Update Product', 'Success');
            //dd($request->all());
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Alert::success('Update Career', 'Success', ['error' => $th->getMessage()]);
            dd($th->getMessage());
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
        return redirect()->route('product.index');
    }

    private function insert_price_logs($product) {
        $logs = ProductPriceLog::create([
            'product_code'  => $product->code,
            'price_store'   => $product->price_store,
            'price_olshop'  => $product->price_olshop,
            'discount_store'    => $product->discount_store,
            'discount_olshop'   => $product->discount_olshop,
            'is_vat'   => $product->is_vat,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            Alert::success('Delete Product', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Product', 'Error' . $th->getMessage());
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
