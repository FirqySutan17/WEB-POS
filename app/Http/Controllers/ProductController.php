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

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Portfolio Show', ['only' => 'index']);
        $this->middleware('permission:Portfolio Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Portfolio Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Portfolio Delete', ['only' => 'destroy']);
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
            $products = Product::search($request->keyword)->orderBy('id', 'desc')->paginate(9);
        } else {
            $products = Product::orderBy('id', 'desc')->paginate(9);
        }
        // dd($products);
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    public function select(Request $request)
    {
        $existing_item = json_decode($request->existing_item);
        $products = Product::select('id', 'code', 'name')->limit(7);
        if (!empty($existing_item)) {
            $products->whereNotIn('code', $existing_item);
        }
        if ($request->has('q')) {
            $products->where('code', 'LIKE', "%{$request->q}%");
        }

        return response()->json($products->get());
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
            'description' => 'required|string',
            'price_store' => 'required|string',
            'price_olshop' => 'required',
            'stock_store' => 'required|string',
            'stock_olshop' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name' => $request->name,
                'code' => $request->code,
                'price_store' => $request->price_store,
                'price_olshop' => $request->price_olshop,
                'description'   => $request->description,
                'stock_store'   => $request->stock_store,
                'stock_olshop'   => $request->stock_olshop,
                'is_active' => ($request->is_active) ? '1' : '0',
            ]);
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
    public function show(Portfolio $portfolio)
    {
        //
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
                'description' => 'required|string',
                'price_store' => 'required|string',
                'price_olshop' => 'required',
                'stock_store' => 'required|string',
                'stock_olshop' => 'required',
            ],
            [],
        );

        DB::beginTransaction();
        try {
            $update_data = [
                'name' => $request->name,
                'code' => $request->code,
                'price_store' => $request->price_store,
                'price_olshop' => $request->price_olshop,
                'description'   => $request->description,
                'stock_store'   => $request->stock_store,
                'stock_olshop'   => $request->stock_olshop,
                'is_active' => ($request->is_active) ? '1' : '0',
            ];

            $update= DB::table('products')->where('id', $product->id)->update($update_data);
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
