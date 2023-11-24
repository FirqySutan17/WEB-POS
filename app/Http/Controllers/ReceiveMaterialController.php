<?php

namespace App\Http\Controllers;

use App\Models\ReceiveMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class ReceiveMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $receiveMaterials = [];
        if ($request->get('keyword')) {
            $receiveMaterials = ReceiveMaterial::orderBy('id', 'desc')->paginate(9);
        } else {
            $receiveMaterials = ReceiveMaterial::orderBy('id', 'desc')->paginate(9);
        }
        // dd($receiveMaterial);
        return view('admin.receive-material.index', [
            'receiveMaterials' => $receiveMaterials
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.receive-material.create');
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
     * @param  \App\Models\ReceiveMaterial  $receiveMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiveMaterial $receiveMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiveMaterial  $receiveMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiveMaterial $receiveMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReceiveMaterial  $receiveMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceiveMaterial $receiveMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiveMaterial  $receiveMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiveMaterial $receiveMaterial)
    {
        //
    }

    private function generatRCVNo() {
        $no_po = date('Ymd')."RCV";
        $no = 1;
        $today = date('Y-m-d');
        $latest_po = ReceiveMaterial::whereDate('date_receive', $today)->orderBy('id', 'DESC')->first();
        if (!empty($latest_po)) {
            $no = substr($latest_po->no_po, -4);

            $date = date('Y-m-d', strtotime($latest_po->created_at));
            $hour = date('H', strtotime($latest_po->created_at));
            $no += 1;
        }

        if ($no < 10) {
            $no = "000".$no;
        } elseif ($no >= 10 && $no < 100) {
            $no = "00".$no;
        } elseif ($no >= 100 && $no < 1000) {
            $no = "0".$no;
        }

        $no_po = $no_po.$no;
        return $no_po;
    }
}
