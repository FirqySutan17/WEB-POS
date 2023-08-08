<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SkillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Skill Show', ['only' => 'index']);
        $this->middleware('permission:Skill Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Skill Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Skill Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skills = [];
        if ($request->get('keyword')) {
            $skills = Skill::search($request->keyword)->orderBy('name', 'desc')->paginate(10);
        } else {
            $skills = Skill::orderBy('name', 'desc')->paginate(10);
        }
        return view('admin.skills.index', [
            'skills' => $skills
        ]);

    }

    public function select(Request $request)
    {
        $skills = [];
        if ($request->has('q')) {
            $skills = Skill::select('id', 'name')->search($request->q)->get();
        } else {
            $skills = Skill::select('id', 'name')->limit(10)->get();
        }

        return response()->json($skills);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('admin.skills.create', compact('statuses'));
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
            'slug' => 'required|string|unique:skill,slug',
            'image' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $file = $request->file('image');
            $namefile = $file->getClientOriginalName();

            $file->move('file_upload', $namefile);
            Skill::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $namefile,
                'is_active' => ($request->is_active) ? '1' : '0',
            ]);
            Alert::success('Add Skill', 'Success');
            // 
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        // dd($request->all());
        return redirect()->route('skill.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        $statuses = $this->statuses();
        return view('admin.skills.edit', compact('skill', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'slug' => 'required|string|unique:skill,slug,' . $skill->id,
        ]);

        DB::beginTransaction();
        try {
            $file = $request->file('image');

            $update_data = [
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => ($request->is_active) ? '1' : '0',
            ];

            if (!empty($file)) {
                $namefile = $file->getClientOriginalName();
                $file->move('file_upload', $namefile);
                $update_data['image'] = $namefile;
            }

            $update= DB::table('skill')->where('id', $skill->id)->update($update_data);
            Alert::success('Update Skill', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('skill.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        try {
            $skill->delete();
            Alert::success('Delete Skill', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Skill', 'Error' . $th->getMessage());
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
