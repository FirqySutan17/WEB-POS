<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProjectTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Project Type Show', ['only' => 'index']);
        $this->middleware('permission:Project Type Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Project Type Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Project Type Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = [];
        if ($request->get('keyword')) {
            $types = ProjectType::search($request->keyword)->orderBy('name', 'desc')->paginate(10);
        } else {
            $types = ProjectType::orderBy('name', 'desc')->paginate(10);
        }
        return view('admin.project-type.index', [
            'types' => $types
        ]);
    }

    public function select(Request $request)
    {
        $types = [];
        if ($request->has('q')) {
            $types = ProjectType::select('id', 'name')->search($request->q)->get();
        } else {
            $types = ProjectType::select('id', 'name')->limit(10)->get();
        }

        return response()->json($types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('admin.project-type.create', compact('statuses'));
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
            'name' => 'required',
            'slug' => 'required|string|unique:project_type,slug',
        ]);

        DB::beginTransaction();
        try {
            ProjectType::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => ($request->is_active) ? '1' : '0',
            ]);
            Alert::success('Add Project Type', 'Success');
            // 
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        // dd($request->all());
        return redirect()->route('project-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectType $projectType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectType $projectType)
    {
        $statuses = $this->statuses();
        return view('admin.project-type.edit', compact('projectType', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectType $projectType)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'slug' => 'required|string|unique:project_type,slug,' . $projectType->id,
        ]);

        DB::beginTransaction();
        try {
            $update_data = [
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => ($request->is_active) ? '1' : '0',
            ];

            $update= DB::table('project_type')->where('id', $projectType->id)->update($update_data);
            Alert::success('Update Project Type', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('project-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectType  $projectType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectType $projectType)
    {
        try {
            $projectType->delete();
            Alert::success('Delete Project Type', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Project Type', 'Error' . $th->getMessage());
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
