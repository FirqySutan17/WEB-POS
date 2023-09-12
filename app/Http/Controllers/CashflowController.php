<?php

namespace App\Http\Controllers;

use App\Models\Cashflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CashflowController extends Controller
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
        $query = Cashflow::whereDate('date', $day)->with('user')->orderBy('created_at', 'desc');
        if ($request->get('keyword')) {
            $query->search($request->keyword);
        }
        if ($role == 'Cashier') {
            $query->where('employee_id', $user->employee_id);
        }
        $cashflow = $query->paginate(5);
        // dd($cashflows);
        return view('admin.cashflow.index', [
            'cashflow' => $cashflow
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cashflow.create');
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
            'date' => 'required',
            'time' => 'required',
            'categories' => 'required',
            'description' => 'required',
            'cash' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $cashflow = Cashflow::create([
                'date' => $request->date,
                'time' => $request->time,
                'employee_id' => Auth::user()->employee_id,
                'categories' => $request->categories,
                'description'   => $request->description,
                'approval'   => $request->approval,
                'cash'   => str_replace(".", "", $request->cash),
            ]);

            Alert::success('Add Cashflow', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('cashflow.index');
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
