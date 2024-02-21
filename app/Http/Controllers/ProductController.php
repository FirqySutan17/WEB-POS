<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
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
            $products = Product::with('supplier')->where('is_active', 1)->search($request->keyword)->orderBy('stock', 'asc')->orderBy('id', 'desc')->paginate(9);
        } else {
            $products = Product::with('supplier')->where('is_active', 1)->orderBy('stock', 'asc')->orderBy('id', 'desc')->paginate(9);
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

    public function select2_product(Request $request)
    {
        $products = Product::select('code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->limit(7);
        if ($request->has('q')) {
            $products->where('code', 'LIKE', $request->q.'%')->orWhere('name', 'LIKE', $request->q.'%');
        }
        if($request->has('supplier_id')) {
            $products->where('supplier_id', $request->supplier_id);
        }

        return response()->json($products->get());
    }

    // public function select2_free_product(Request $request)
    // {
    //     $products = Product::select('code', 'name')->orderBy('code', 'ASC')->orderBy('name', 'ASC')->limit(7);
    //     if ($request->has('q')) {
    //         $products->where('code', 'LIKE', $request->q.'%')->orWhere('name', 'LIKE', $request->q.'%');
    //     }
    //     if($request->has('supplier_id')) {
    //         $products->where('supplier_id', $request->supplier_id);
    //     }

    //     return response()->json($products->get());
    // }

    public function select_one(Request $request)
    {
        $product_code = $request->product_code;
        $source = !empty($request->source) ? $request->source : "";
        $supplier_id = !empty($request->supplier_id) ? $request->supplier_id : "";
        $result = [
            "status"    => "failed",
            "message"   => "Product not found",
            "data"      => []
        ];

        if (!empty($product_code)) {
            $query = Product::select('id', 'code', 'name', 'price_store', 'discount_store', 'stock', 'is_vat')->where('code', $product_code);
            if (!empty($supplier_id)) {
                $query->where('supplier_id', $supplier_id);
            }
            $products = $query->first();
            if (!empty($products)) {
                $result["message"]  = "";
                $result["status"]   = "success";
                $result["data"]     = $products;
                if ($source == 'transaction' && $products->stock < 1) {
                    $result["message"]  = "Empty stock!";
                    $result["status"]   = "failed";
                    $result["data"]     = [];
                }

                if ($products->is_vat == 1) {
                    $vat_percent    = config('app.vat_amount');
                    $vat_amount     = round(($products->price_store / 100) * $vat_percent);
                    $products->price_store = $products->price_store + $vat_amount;
                }
            }
        }

        return response()->json($result);
    }

    public function select_trans(Request $request)
    {
        $products = [];
        if ($request->has('q')) {
            $products = Product::select('id', 'name')->search($request->q)->get();
        } else {
            $products = Product::select('id', 'name')->limit(10)->get();
        }

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.product.create', compact('suppliers'));
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
            'code' => 'required|string|unique:products,code',
            'name' => 'required',
            'supplier_id' => 'required',
            'price_store' => 'required|string',
            'price_olshop' => 'required',
            'categories' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name' => $request->name,
                'code' => $request->code,
                'supplier_id' => $request->supplier_id,
                'price_store' => str_replace(".", "", $request->price_store),
                'price_olshop' => str_replace(".", "", $request->price_olshop),
                'discount_store' => $request->discount_store,
                'discount_olshop' => $request->discount_olshop,
                'description'   => $request->description,
                'categories'   => $request->kategori,
                'stock'   => 0,
                'is_active' => ($request->is_active) ? '1' : '0',
                'is_vat' => ($request->is_vat) ? '1' : '0',
            ]);

            $product->types()->attach($request->categories);

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
        $data = [
            "product"       => $product,
            "price_logs"    => $price_logs,
            "types"         => $product->types,
        ];
        return response()->json($data);
    }

    public function print(Product $product) {
        return view('admin.product.print', compact('product'));
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
        $supplier = Supplier::all();
        $supplierSelected = $product->supplier;
// dd($supplierSelected);
        return view('admin.product.edit', compact('product', 'supplier', 'supplierSelected'));

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
                'supplier_id' => 'required',
                'code' => 'required|string|unique:products,code,' .  $product->id,
                'price_store' => 'required|string',
                'price_olshop' => 'required',
                'categories' => 'required',
            ],
            [],
        );

        if ($validator->fails()) {
            if ($request['categories']) {
                $request['categories'] = ProductCategory::select('id', 'categories')->whereIn('id', $request->categories)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $update_data = [
                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'price_store' => str_replace(".", "", $request->price_store),
                'price_olshop' => str_replace(".", "", $request->price_olshop),
                'discount_store' => $request->discount_store,
                'discount_olshop' => $request->discount_olshop,
                'description'   => $request->description,
                'categories'   => $request->kategori,
                'is_active' => ($request->is_active) ? '1' : '0',
                'is_vat' => ($request->is_vat) ? '1' : '0',
            ];

            $product->types()->sync($request->categories);
            $update= DB::table('products')->where('id', $product->id)->update($update_data);
            $check_price_logs = ProductPriceLog::where('product_code')->first();

            $product->price_store       = str_replace(".", "", $request->price_store);
            $product->price_olshop      = str_replace(".", "", $request->price_olshop);
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
            if ($request['categories']) {
                $request['categories'] = ProductCategory::select('id', 'categories')->whereIn('id', $request->categories)->get();
            }
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
