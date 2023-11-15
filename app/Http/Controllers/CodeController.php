<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $codes = [];
        if ($request->get('keyword')) {
            $codes = Code::search($request->keyword)->orderBy('code_name', 'desc')->paginate(10);
        } else {
            $codes = Code::orderBy('code_name', 'desc')->paginate(10);
        }
        return view('admin.code.index', [
            'codes' => $codes
        ]);
    }

    public function select(Request $request)
    {
        $codes = [];
        if ($request->has('q')) {
            $codes = Code::select('id', 'code_name', 'head')->search($request->q)->get();
        } else {
            $codes = Code::select('id', 'code_name', 'head')->get();
        }

        return response()->json($codes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('admin.code.create', compact('statuses'));
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
            'head' => 'required',
            'code_name' => 'required',
        ]);

        DB::beginTransaction();
        try {
            Code::create([
                'head' => $request->head,
                'code_name' => $request->code_name,
            ]);
            Alert::success('Add Code', 'Success');
            // 
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        // dd($request->all());
        return redirect()->route('code.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        $statuses = $this->statuses();
        return view('admin.code.edit', compact('code', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        $request->validate([
            'head' => 'required',
            'code_name' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $update_data = [
                'head' => $request->head,
                'code_name' => $request->code_name,
            ];

            $update= DB::table('mst_code')->where('id', $code->id)->update($update_data);
            Alert::success('Update Code', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('code.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        try {
            $code->delete();
            Alert::success('Delete Code', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Code', 'Error' . $th->getMessage());
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
