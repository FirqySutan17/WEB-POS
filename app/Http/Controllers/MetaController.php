<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Meta Show', ['only' => 'index']);
        $this->middleware('permission:Meta Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Meta Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Meta Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meta = [];
        if ($request->get('keyword')) {
            $meta = Meta::search($request->keyword)->orderBy('created_at', 'asc')->paginate(9);
        } else {
            $meta = Meta::orderBy('created_at', 'asc')->paginate(9);
        }
        return view('admin.meta.index', [
            'meta' => $meta,
            'statuses' => $this->statuses()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = Meta::all();
        $statuses = $this->statuses();
        return view('admin.meta.create', compact('meta', 'statuses'));
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
            'slug' => 'required|string|unique:meta,slug',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'meta_robots' => 'required',
            'og_title' => 'required',
            'og_site_name' => 'required',
            'og_description' => 'required',
            'og_url' => 'required',
            'og_image' => 'required',
            'og_image_width' => 'required',
            'og_image_height' => 'required',
            'og_type' => 'required',
            'og_locale' => 'required',
            'og_alternate' => 'required',
            'twitter_card' => 'required',
            'twitter_title' => 'required',
            'twitter_description' => 'required',
            'twitter_image' => 'required',
            'twitter_creator' => 'required',
            'twitter_site' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $fileTimage = $request->file('twitter_image');
            $twitterImage = $fileTimage->getClientOriginalName();

            $fileTimage->move('file_upload', $twitterImage);

            $fileOgimage = $request->file('og_image');
            $ogImage = $fileOgimage->getClientOriginalName();

            $fileOgimage->move('file_upload', $ogImage);
            
            Meta::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'meta_robots' => $request->meta_robots,
                'og_title' => $request->og_title,
                'og_site_name' => $request->og_site_name,
                'og_description' => $request->og_description,
                'og_url' => $request->og_url,
                'og_image' => $ogImage,
                'og_image_width' => $request->og_image_width,
                'og_image_height' => $request->og_image_height,
                'og_type' => $request->og_type,
                'og_locale' => $request->og_locale,
                'og_alternate' => $request->og_alternate,
                'twitter_card' => $request->twitter_card,
                'twitter_title' => $request->twitter_title,
                'twitter_description' => $request->twitter_description,
                'twitter_image' => $twitterImage,
                'twitter_creator' => $request->twitter_creator,
                'twitter_site' => $request->twitter_site,
                'schema_markup' => $request->schema_markup,
            ]);
            Alert::success('Add Meta', 'Success');
            // dd($request->all());
            return redirect()->route('metas.index');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function edit(Meta $meta)
    {
        $statuses = $this->statuses();
        return view('admin.meta.edit', compact('meta', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meta $meta)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|string|unique:meta,slug,' . $meta->id,
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'meta_robots' => 'required',
            'og_title' => 'required',
            'og_site_name' => 'required',
            'og_description' => 'required',
            'og_url' => 'required',
            'og_image_width' => 'required',
            'og_image_height' => 'required',
            'og_type' => 'required',
            'og_locale' => 'required',
            'og_alternate' => 'required',
            'twitter_card' => 'required',
            'twitter_title' => 'required',
            'twitter_description' => 'required',
            'twitter_creator' => 'required',
            'twitter_site' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $fileTimage = $request->file('twitter_image');
            $fileOgimage = $request->file('og_image');

            $update_data = [
                'name' => $request->name,
                'slug' => $request->slug,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'meta_robots' => $request->meta_robots,
                'og_title' => $request->og_title,
                'og_site_name' => $request->og_site_name,
                'og_description' => $request->og_description,
                'og_url' => $request->og_url,
                'og_image_width' => $request->og_image_width,
                'og_image_height' => $request->og_image_height,
                'og_type' => $request->og_type,
                'og_locale' => $request->og_locale,
                'og_alternate' => $request->og_alternate,
                'twitter_card' => $request->twitter_card,
                'twitter_title' => $request->twitter_title,
                'twitter_description' => $request->twitter_description,
                'twitter_creator' => $request->twitter_creator,
                'twitter_site' => $request->twitter_site,
                'schema_markup' => $request->schema_markup,
            ];

            if (!empty($fileTimage)) {
                $namefileTwitter = $fileTimage->getClientOriginalName();
                $fileTimage->move('file_upload', $namefileTwitter);
                $update_data['twitter_image'] = $namefileTwitter;
            }

            if (!empty($fileOgimage)) {
                $namefileOg = $fileOgimage->getClientOriginalName();
                $fileOgimage->move('file_upload', $namefileOg);
                $update_data['og_image'] = $namefileOg;
            }

            $update= DB::table('meta')->where('id', $meta->id)->update($update_data);
            Alert::success('Update Meta', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('metas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meta $meta)
    {
        try {
            $meta->delete();
            Alert::success('Delete Meta', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Meta', 'Error' . $th->getMessage());
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
