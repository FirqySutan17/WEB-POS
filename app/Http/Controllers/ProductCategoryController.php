<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:PC Show', ['only' => 'index']);
        $this->middleware('permission:PC Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:PC Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:PC Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = [];
        if ($request->get('keyword')) {
            $categories = ProductCategory::search($request->keyword)->orderBy('categories', 'desc')->paginate(10);
        } else {
            $categories = ProductCategory::orderBy('categories', 'desc')->paginate(10);
        }
        return view('admin.product-categories.index', [
            'categories' => $categories
        ]);
    }

    public function select(Request $request)
    {
        $categories = [];
        if ($request->has('q')) {
            $categories = ProductCategory::select('id', 'categories')->search($request->q)->get();
        } else {
            $categories = ProductCategory::select('id', 'categories')->limit(10)->get();
        }

        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('admin.product-categories.create', compact('statuses'));
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
            'categories' => 'required',
            'slug' => 'required|string|unique:product_categories,slug',
        ]);

        DB::beginTransaction();
        try {
            ProductCategory::create([
                'categories' => $request->categories,
                'slug' => $request->slug,
            ]);
            Alert::success('Add Product Categories', 'Success');
            // 
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        // dd($request->all());
        return redirect()->route('product-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        $statuses = $this->statuses();

        return view('admin.product-categories.edit', compact('productCategory', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'categories' => 'required|string|max:60',
            'slug' => 'required|string|unique:product_categories,slug,' . $productCategory->id,
        ]);

        DB::beginTransaction();
        try {
            $update_data = [
                'categories' => $request->categories,
                'slug' => $request->slug,
            ];

            $update= DB::table('product_categories')->where('id', $productCategory->id)->update($update_data);
            Alert::success('Update Product Categories', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('product-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        try {
            $productCategory->delete();
            Alert::success('Delete Product Categories', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Product Categories', 'Error' . $th->getMessage());
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
