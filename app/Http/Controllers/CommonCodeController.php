<?php

namespace App\Http\Controllers;

use App\Models\CommonCode;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CommonCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commons = [];
        if ($request->get('keyword')) {
            $commons = CommonCode::with('code_head')->search($request->keyword)->orderBy('id', 'desc')->paginate(9);
        } else {
            $commons = CommonCode::with('code_head')->orderBy('id', 'desc')->paginate(9);
        }
        // dd($commons);
        return view('admin.common.index', [
            'commons' => $commons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codes = Code::all();
        return view('admin.common.create', compact('codes'));
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
            'head_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $commonCode = CommonCode::create([
                'head_id' => $request->head_id,
                'code' => $request->code,
                'name' => $request->name,
                'description'   => $request->description,
                'is_active' => ($request->is_active) ? '1' : '0',
            ]);

            Alert::success('Add Common Code', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('common-code.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommonCode  $commonCode
     * @return \Illuminate\Http\Response
     */
    public function show(CommonCode $commonCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommonCode  $commonCode
     * @return \Illuminate\Http\Response
     */
    public function edit(CommonCode $commonCode)
    {

        $commonCode = CommonCode::with('code_head')->first();
        $statuses = $this->statuses();
        $code = Code::all();
        $codeSelected = $commonCode->code_head;

        // dd($codeSelected);
        return view('admin.common.edit', compact('commonCode', 'code', 'codeSelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommonCode  $commonCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommonCode $commonCode)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'head_id' => 'required',
                'code' => 'required',
                'name' => 'required',
                'description' => 'required|string',
            ],
            [],
        );

        DB::beginTransaction();
        try {
            $update_data = [
                'head_id' => $request->head_id,
                'code' => $request->code,
                'name' => $request->name,
                'description'   => $request->description,
                'is_active' => ($request->is_active) ? '1' : '0',
            ];

            $update= DB::table('mst_common_code')->where('id', $commonCode->id)->update($update_data);

            Alert::success('Update Code', 'Success');
            //dd($request->all());
            return redirect()->route('common-code.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Alert::success('Update Career', 'Success', ['error' => $th->getMessage()]);
            dd($th->getMessage());
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
        return redirect()->route('common-code.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommonCode  $commonCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommonCode $commonCode)
    {
        try {
            $commonCode->delete();
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
