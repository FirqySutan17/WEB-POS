<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = [];
        if ($request->get('keyword')) {
            $suppliers = Supplier::search($request->keyword)->orderBy('name', 'desc')->paginate(10);
        } else {
            $suppliers = Supplier::orderBy('name', 'desc')->paginate(10);
        }
        return view('admin.supplier.index', [
            'suppliers' => $suppliers
        ]);
    }

    public function select(Request $request)
    {
        $suppliers = [];
        if ($request->has('q')) {
            $suppliers = Supplier::select('id', 'name', 'supplier_code')->search($request->q)->get();
        } else {
            $suppliers = Supplier::select('id', 'name', 'supplier_code')->get();
        }

        return response()->json($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('admin.supplier.create', compact('statuses'));
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
            'supplier_code' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        DB::beginTransaction();
        try {
            Supplier::create([
                'supplier_code' => $request->supplier_code,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);
            Alert::success('Add Supplier', 'Success');
            // 
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        // dd($request->all());
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $statuses = $this->statuses();
        return view('admin.supplier.edit', compact('supplier', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'supplier_code' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $update_data = [
                'supplier_code' => $request->supplier_code,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ];

            $update= DB::table('suppliers')->where('id', $supplier->id)->update($update_data);
            Alert::success('Update Supplier', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            Alert::success('Delete Supplier', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Supplier', 'Error' . $th->getMessage());
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
