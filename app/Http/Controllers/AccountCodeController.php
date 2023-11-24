<?php

namespace App\Http\Controllers;

use App\Models\AccountCode;
use Illuminate\Http\Request;

class AccountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.account-code.edit');
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
     * @param  \App\Models\AccountCode  $accountCode
     * @return \Illuminate\Http\Response
     */
    public function show(AccountCode $accountCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountCode  $accountCode
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountCode $accountCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountCode  $accountCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountCode $accountCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountCode  $accountCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountCode $accountCode)
    {
        //
    }
}
