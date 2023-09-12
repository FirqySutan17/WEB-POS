<?php

namespace App\Http\Controllers;

use App\Models\ClosingDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ClosingdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClosingDate  $closingDate
     * @return \Illuminate\Http\Response
     */
    public function show(ClosingDate $closingDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClosingDate  $closingDate
     * @return \Illuminate\Http\Response
     */
    public function edit(ClosingDate $closingDate)
    {
        return view('admin.closing-date.edit', compact('closingDate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClosingDate  $closingDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClosingDate $closingDate)
    {
        DB::beginTransaction();
        try {
           
            $update_data = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];

            $update= DB::table('cl_date')->where('id', $closingDate->id)->update($update_data);
            Alert::success('Update Closing Date', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClosingDate  $closingDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClosingDate $closingDate)
    {
        //
    }
}
