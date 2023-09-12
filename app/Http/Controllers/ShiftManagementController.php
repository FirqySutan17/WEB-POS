<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ShiftManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shift      = 1;
        $today      = date('Y-m-d');
        $ystrdy  = date('Y-m-d', strtotime('-1 days'));
        $user       = Auth::user();
        $authorized = 1;
        $begin      = 0;
        $auth_pin   = $user->pin;
        $current_shift  = Shift::whereDate('date', $today)->with('user')->orderBy('seq', 'DESC')->first();
        $prev_shift     = Shift::whereDate('date', $ystrdy)->with('user')->orderBy('seq', 'DESC')->first();
        if (!empty($prev_shift)) {
            $begin = $prev_shift->end;
        }

        if (!empty($current_shift)) {
            if ($current_shift->status == 'FINISH') {
                $shift    = $current_shift->seq + 1;
                $begin    = $current_shift->end;
            } elseif ($current_shift->status == 'IN_PROGRESS') {
                $begin    = $current_shift->begin;
                $auth_pin = $current_shift->user->pin;
            }
            if ($current_shift->user->employee_id != $user->employee_id) {
                $authorized = 0;
            }
        }

        
        $data = [
            "shift_number"  => $shift,
            "shift_data"    => $current_shift,
            "begin"         => $begin,
            "authorized"    => $authorized,
            "auth_pin"      => $auth_pin
        ];
        return view('admin.shift_management.create', compact('data'));
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
            'employee_id' => 'required',
            'seq' => 'required',
            'pin' => 'required',
            'cash' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $status = $request->status;
            if ($status == 'START') {
                $begin = str_replace(".", "", $request->cash);
                $shift = Shift::create([
                    'date' => $request->date,
                    'start_time' => date('H:i:s'),
                    'employee_id' => $request->employee_id,
                    'begin' => $begin,
                    'status'   => "IN_PROGRESS",
                    'seq'   => $request->seq,
                ]);

                Alert::success('Start Shift', 'Success');
            }
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('shift.index');
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

    public function closing_shift(Request $request) {
        $shift_id = $request->id;
        $end_time = $request->end_time;
        $estimated_end = $request->estimated_end;
        $end        = $request->cash;
        $status = "FINISH";

        $end_shift = [
            "end_time" =>    $end_time,
            "estimated_end" => $estimated_end,
            "end"   => $end,
            "status"    => $status
        ];
        DB::table('shift_management')->where('id', $shift_id)->update($end_shift);

        return redirect()->route('shift.index');
    }

    public function summary_shift()
    {
        $today      = date('Y-m-d');
        $time       = date('H:i').":59";
        $end_time  = $today." ".$time;

        $current_shift  = Shift::whereDate('date', $today)->where('status', 'IN_PROGRESS')->with('user')->orderBy('seq', 'DESC')->first();
        $cash_balance   = $this->get_cash_balance($today, $time, $end_time);
        $data           = $this->calculate_cashflow($current_shift, $cash_balance, $end_time);
        return view('admin.shift_management.summary', compact('data'));
    }

    private function calculate_cashflow($current_shift, $cash_balance, $end_time) {
        $data = [
            "current_shift" => $current_shift,
            "cash_balance"  => $cash_balance,
            "cash_in" => 0,
            "cash_out" => 0,
            "estimated_ending" => 0,
            "end_time"      => $end_time
        ];

        $cash_in = 0;
        $cash_out = 0;
        $estimated_ending = (int) $current_shift->begin;
        foreach ($cash_balance as $v) {
            $amount = (int) $v->amount;
            if ($v->type_balance == "D") {
                // PLUS CASHFLOW
                $cash_in += $amount;
                $estimated_ending += $amount;
            } elseif ($v->type_balance == "K") {
                // MINUS CASHFLOW
                $cash_out += $amount;
                $estimated_ending -= $amount;
            }
        }

        $data["cash_in"] = $cash_in;
        $data["cash_out"] = $cash_out;
        $data["estimated_ending"] = $estimated_ending;
        return $data;
    }

    private function get_cash_balance($date, $time, $end_time)
    {
        $query = "
            SELECT * FROM (
                SELECT 
                    'transaction' AS type_flow, invoice_no AS code_data, total_price AS amount, created_at, 'D' AS type_balance 
                FROM tr_transaction
                WHERE trans_date = '$date' AND created_at <= '$end_time'
                UNION ALL
                SELECT 
                    'cash_in' AS type_flow, CONCAT('CASH IN EMP ', employee_id) AS code_data, cash AS amount, created_at, 'D' AS type_balance 
                FROM cash_flow
                WHERE date = '$date' AND TIME <= '$time' AND categories = 'IN'
                UNION ALL
                SELECT 
                    'cash_out' AS type_flow, CONCAT('CASH OUT EMP ', employee_id) AS code_data, cash AS amount, created_at, 'K' AS type_balance 
                FROM cash_flow
                WHERE date = '$date' AND TIME <= '$time' AND categories = 'OUT'
                UNION ALL
                SELECT 
                    'setor_cash' AS type_flow, CONCAT('SETORAN CASH EMP ', employee_id) AS code_data, cash AS amount, created_at, 'K' AS type_balance 
                FROM cash_flow
                WHERE date = '$date' AND TIME <= '$time' AND categories = 'STR'
            ) AS data
            ORDER BY data.created_at ASC
        ";
        $db_query = DB::select(DB::raw($query));
        return $db_query;
    }

    private function statuses()
    {
        return [
            '0' => 'Draft',
            '1' => 'Published',
        ];
    }
}
