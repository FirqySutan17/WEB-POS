<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $memberships = [];
        if ($request->get('keyword')) {
            $memberships = Membership::search($request->keyword)->orderBy('created_at', 'asc')->orderBy('id', 'desc')->paginate(9);
        } else {
            $memberships = Membership::orderBy('created_at', 'asc')->orderBy('id', 'desc')->paginate(9);
        }
        // dd($memberships);
        return view('admin.membership.index', [
            'memberships' => $memberships
        ]);
    }

    public function select(Request $request)
    {
        $memberships = [];
        if ($request->has('q')) {
            $memberships = Membership::select('id', 'code', 'name', 'phone')->search($request->q)->get();
        } else {
            $memberships = Membership::select('id', 'code', 'name', 'phone')->limit(10)->get();
        }

        return response()->json($memberships);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.membership.create');
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
            'code' => 'required|unique:memberships,code',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $membership = Membership::create([
                'code' => $request->code,
                'name' => $request->name,
                'phone' => $request->phone,
                'email'   => $request->email,
            ]);

            Alert::success('Add Membership', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('membership.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        return view('admin.membership.edit', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|unique:memberships,code,' . $membership->id,
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|string',
            ],
            [],
        );
        
        DB::beginTransaction();
        try {
            $update_data = [
                'code' => $request->code,
                'name' => $request->name,
                'phone' => $request->phone,
                'email'   => $request->email,
            ];

            $update= DB::table('memberships')->where('id', $membership->id)->update($update_data);

            Alert::success('Update Membership', 'Success');
            //dd($request->all());
            return redirect()->route('membership.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Alert::success('Update Career', 'Success', ['error' => $th->getMessage()]);
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('membership.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        try {
            $membership->delete();
            Alert::success('Delete Membership', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Membership', 'Error' . $th->getMessage());
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
