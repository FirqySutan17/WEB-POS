<?php

namespace App\Http\Controllers;

use App\Models\SingleUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SingleUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Hww Show', ['only' => 'index']);
        $this->middleware('permission:Hww Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Hww Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Hww Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $singleuploads = [];
        if ($request->get('keyword')) {
            $singleuploads = SingleUpload::search($request->keyword)->orderBy('id', 'desc')->paginate(9);
        } else {
            $singleuploads = SingleUpload::orderBy('id', 'asc')->paginate(9);
        }
        return view('admin.single_upload.index', [
            'singleuploads' => $singleuploads
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hwws = SingleUpload::all();
        return view('admin.single_upload.create', compact('hwws'));

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
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $file = $request->file('image');
            $namefile = $file->getClientOriginalName();

            $file->move('file_upload', $namefile);
            $banner = DB::table('single_upload')->insertGetId([
                'title' => $request->title,
                'description'   => $request->description,
                'image' => $namefile
            ]);
            Alert::success('Add Single Upload', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('single_upload.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(SingleUpload $single_upload)
    {
        return view('admin.single_upload.edit', compact('single_upload'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SingleUpload $single_upload)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $file = $request->file('image');

            $update_data = [
                'title' => $request->title,
                'description' => $request->description,
            ];

            if (!empty($file)) {
                $namefile = $file->getClientOriginalName();
                $file->move('file_upload', $namefile);
                $update_data['image'] = $namefile;
            }

            $update= DB::table('single_upload')->where('id', $single_upload->id)->update($update_data);
            
            Alert::success('Update Single Upload', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }

        return redirect()->route('single_upload.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(SingleUpload $single_upload)
    {
        try {
            $single_upload->delete();
            Alert::success('Delete Single Upload', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Single Upload', 'Error' . $th->getMessage());
        }
        return redirect()->back();
    }
}
