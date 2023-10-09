<?php

namespace App\Http\Controllers;

use App\Models\AdjustStock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdjustStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user   = Auth::user();
        $role   = $user->roles->first()->name;
        $day    = date('Y-m-d');
        $query = AdjustStock::whereDate('date', $day)->with('product', 'user', 'user_approval')->orderBy('created_at', 'desc');
        if ($request->get('keyword')) {
            $query->search($request->keyword);
        }
        if ($role == 'Cashier') {
            $query->where('employee_id', $user->employee_id);
        }
        $adjust_stock = $query->paginate(5);
        // dd($adjust_stock);
        return view('admin.adjust_stock.index', [
            'adjust_stock' => $adjust_stock
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adjust_stock.create');
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
            'date' => 'required',
            'time' => 'required',
            'type' => 'required',
            'remark' => 'required',
            'product_code' => 'required',
            'qty' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $cashflow = AdjustStock::create([
                'date' => $request->date,
                'time' => $request->time,
                'employee_id' => Auth::user()->employee_id,
                'type' => $request->type,
                'product_code' => $request->product_code,
                'remark'   => $request->remark,
                'approval'   => $request->approval,
                'qty'   => $request->qty,
            ]);

            $product = Product::where('code', $request->product_code)->first();
            $product->stock = $product->stock + $request->qty;
            $product->save();

            Alert::success('Add Adjustment Stock', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('adjust_stock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cashflow  $cashflow
     * @return \Illuminate\Http\Response
     */
    public function show(Cashflow $cashflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cashflow  $cashflow
     * @return \Illuminate\Http\Response
     */
    public function edit(Cashflow $cashflow)
    {
        return view('admin.cashflow.edit', compact('cashflow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cashflow  $cashflow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cashflow $cashflow)
    {
        dd($cashflow);
        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required',
                'time' => 'required',
                'categories' => 'required',
                'description' => 'required',
                'cash' => 'required',
            ],
            [],
        );
        
        DB::beginTransaction();
        try {
            $update_data = [
                'date' => $request->date,
                'time' => $request->time,
                'employee_id' => $request->employee_id,
                'categories' => $request->categories,
                'description'   => $request->description,
                'approval'   => $request->approval,
                'cash'   => $request->cash,
            ];

            $update= DB::table('cashflows')->where('id', $cashflow->id)->update($update_data);

            Alert::success('Update Cashflow', 'Success');
            //dd($request->all());
            return redirect()->route('cashflow.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Alert::success('Update Career', 'Success', ['error' => $th->getMessage()]);
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('cashflow.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cashflow  $cashflow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cashflow $cashflow)
    {
        try {
            $cashflow->delete();
            Alert::success('Delete Cashflow', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Cashflow', 'Error' . $th->getMessage());
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
