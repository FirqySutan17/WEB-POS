<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:PC Show', ['only' => 'index']);
        $this->middleware('permission:PC Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:PC Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:PC Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $portfolios = [];
        if ($request->get('keyword')) {
            $portfolios = Portfolio::search($request->keyword)->orderBy('id', 'desc')->paginate(9);
        } else {
            $portfolios = Portfolio::orderBy('id', 'desc')->paginate(9);
        }
        // dd($portfolios);
        return view('admin.portfolio.index', [
            'portfolios' => $portfolios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolio.create');
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
            'client_name' => 'required',
            'slug' => 'required|string|unique:portfolio,slug',
            'project_title' => 'required',
            'link' => 'required',
            'description' => 'required|string',
            'description_2' => 'required|string',
            'start_year' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $portfolio = Portfolio::create([
                'client_name' => $request->client_name,
                'slug' => $request->slug,
                'project_title' => $request->project_title,
                'link' => $request->link,
                'description'   => $request->description,
                'description_2'   => $request->description_2,
                'start_year'   => $request->start_year,
                'end_year'   => $request->end_year,
                'is_active' => ($request->is_active) ? '1' : '0',
            ]);
            $portfolio->skills()->attach($request->skill);

            $files = $request->file('image');
            $alt_text      = $request->alt_text;
            $hover_text      = $request->hover_text;
            $image_arr = [];
            if (!empty($portfolio) && !empty($files)) {
                foreach ($files as $key => $v) {
                    $namefile = $v->getClientOriginalName();
                    $v->move('file_upload', $namefile);
                    $image_arr[] = [
                        'portfolio_id' => $portfolio->id,
                        'image'   => $namefile,
                        'alt_text'        => !empty($alt_text[$key]) ? $alt_text[$key] : "",
                        'hover_text'      => !empty($hover_text[$key]) ? $hover_text[$key] : "",
                    ];
                }

                DB::table('portfolio_image')->insert($image_arr);
            }

            $files_slider = $request->file('image_slider');
            $alt_text_slider      = $request->alt_text_slider;
            $hover_text_slider      = $request->hover_text_slider;
            $image_arr_slider = [];
            if (!empty($portfolio) && !empty($files_slider)) {
                foreach ($files_slider as $key_slider => $v_slider) {
                    $namefile_slider = $v_slider->getClientOriginalName();
                    $v_slider->move('file_upload', $namefile_slider);
                    $image_arr_slider[] = [
                        'portfolio_id' => $portfolio->id,
                        'image_slider'   => $namefile_slider,
                        'alt_text_slider'        => !empty($alt_text_slider[$key_slider]) ? $alt_text_slider[$key_slider] : "",
                        'hover_text_slider'      => !empty($hover_text_slider[$key_slider]) ? $hover_text_slider[$key_slider] : "",
                    ];
                }

                DB::table('portfolio_slider')->insert($image_arr_slider);
            }
            Alert::success('Add Portfolio', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('portfolio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $statuses = $this->statuses();
        $portfolio_image = DB::table('portfolio_image')->where('portfolio_id', $portfolio->id)->orderBy('id', 'asc')->get();
        $portfolio_slider = DB::table('portfolio_slider')->where('portfolio_id', $portfolio->id)->orderBy('id', 'asc')->get();

        return view('admin.portfolio.edit', compact('portfolio', 'portfolio_image', 'portfolio_slider'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'client_name' => 'required',
                'slug' => 'required|string|unique:portfolio,slug,' . $portfolio->id,
                'project_title' => 'required',
                'link' => 'required',
                'description' => 'required|string',
                'description_2' => 'required|string',
                'start_year' => 'required',
            ],
            [],
        );

        if ($validator->fails()) {
            if ($request['skill']) {
                $request['skill'] = Skill::select('id', 'name')->whereIn('id', $request->skill)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        DB::beginTransaction();
        try {
            $update_data = [
                'client_name' => $request->client_name,
                'slug' => $request->slug,
                'project_title' => $request->project_title,
                'link' => $request->link,
                'description'   => $request->description,
                'description_2'   => $request->description_2,
                'start_year'   => $request->start_year,
                'end_year'   => $request->end_year,
                'is_active' => ($request->is_active) ? '1' : '0',
            ];

            $portfolio->skills()->sync($request->skill);
            $update= DB::table('portfolio')->where('id', $portfolio->id)->update($update_data);

            $files = $request->file('image');
            $alt_text      = $request->alt_text;
            $hover_text      = $request->hover_text;
            $image_old_file     = $request->old_file;
            $image_arr = [];
            if (!empty($portfolio) && !empty($alt_text)) {
                // dd($request->all());
                foreach ($alt_text as $key => $v) {
                    $old_file = isset($image_old_file[$key]) ? $image_old_file[$key] : "";
                    $new_file = isset($files[$key]) ? $files[$key] : null;
                    if (!empty($new_file)) {
                        $namefile = $new_file->getClientOriginalName();
                        $new_file->move('file_upload', $namefile);
                    } else {
                        $namefile = $old_file;
                    }
                    
                    $image_arr[] = [
                        'portfolio_id'    => $portfolio->id,
                        'image'         => $namefile,
                        'alt_text'        => !empty($alt_text[$key]) ? $alt_text[$key] : "",
                        'hover_text'        => !empty($hover_text[$key]) ? $hover_text[$key] : "",
                    ];
                }
                // dd($image_arr, $request->all());
                DB::table('portfolio_image')->where('portfolio_id', $portfolio->id)->delete();
                DB::table('portfolio_image')->insert($image_arr);
            }

            $files_slider = $request->file('image_slider');
            $alt_text_slider      = $request->alt_text_slider;
            $hover_text_slider      = $request->hover_text_slider;
            $image_old_file_slider     = $request->old_file_slider;
            $image_arr_slider = [];
            if (!empty($portfolio) && !empty($alt_text_slider)) {
                // dd($request->all());
                foreach ($alt_text_slider as $key_slider => $v_slider) {
                    $old_file_slider = isset($image_old_file_slider[$key_slider]) ? $image_old_file_slider[$key_slider] : "";
                    $new_file_slider = isset($files_slider[$key_slider]) ? $files_slider[$key_slider] : null;
                    if (!empty($new_file_slider)) {
                        $namefile_slider = $new_file_slider->getClientOriginalName();
                        $new_file_slider->move('file_upload', $namefile_slider);
                    } else {
                        $namefile_slider = $old_file_slider;
                    }
                    
                    $image_arr_slider[] = [
                        'portfolio_id'    => $portfolio->id,
                        'image_slider'         => $namefile_slider,
                        'alt_text_slider'        => !empty($alt_text_slider[$key_slider]) ? $alt_text_slider[$key_slider] : "",
                        'hover_text_slider'        => !empty($hover_text_slider[$key_slider]) ? $hover_text_slider[$key_slider] : "",
                    ];
                }
                // dd($image_arr_slider, $request->all());
                DB::table('portfolio_slider')->where('portfolio_id', $portfolio->id)->delete();
                DB::table('portfolio_slider')->insert($image_arr_slider);
            }

            Alert::success('Update Portfolio', 'Success');
            //dd($request->all());
            return redirect()->route('portfolio.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Alert::success('Update Career', 'Success', ['error' => $th->getMessage()]);
            dd($th->getMessage());
            if ($request['skill']) {
                $request['skill'] = Skill::select('id', 'name')->whereIn('id', $request->skill)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
        return redirect()->route('portfolio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        try {
            $portfolio->delete();
            Alert::success('Delete Portfolio', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Portfolio', 'Error' . $th->getMessage());
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
