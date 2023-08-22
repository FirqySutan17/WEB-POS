<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Receive;
use App\Models\Product;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:Portfolio Show', ['only' => 'index']);
        $this->middleware('permission:Portfolio Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Portfolio Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Portfolio Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $receives = [];
        if ($request->get('keyword')) {
            $receives = Receive::search($request->keyword)->orderBy('id', 'desc')->paginate(9);
        } else {
            $receives = Receive::orderBy('id', 'desc')->paginate(9);
        }
        // dd($receives);
        return view('admin.transaction.index', [
            'receives' => $receives
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.purchase_order.create');
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
            'receive_date' => 'required',
            'driver' => 'required',
            'driver_phone' => 'required',
            'plat_no' => 'required|string',
            'suratjalan_number' => 'required|string',
            // 'suratjalan_file' => 'required'
        ]);

        if (empty($request->product_code)) {
            return redirect()->back()->withInput($request->all())->withErrors("Tidak ada product yang dipilih");
        }

        DB::beginTransaction();
        try {
            $receive_code = "RCV".date("YMDHis");
            $receive = Receive::create([
                'receive_code'  => $receive_code,
                'receive_date'  => $request->receive_date,
                'driver'        => $request->driver,
                'driver_phone'  => $request->driver_phone,
                'plat_no'       => $request->plat_no,
                'suratjalan_number'   => $request->suratjalan_number
            ]);

            if ($request->file('suratjalan_file')) {
                $file = $request->file('suratjalan_file');
                $original_name = $file->getClientOriginalName();
                $ext = pathinfo($original_name, PATHINFO_EXTENSION);
                $namefile = "suratjalan_".$receive_code.".".$ext;

                $file->move('file_upload', $namefile);
            }

            $product_code   = $request->product_code;
            $amount         = $request->amount;
            $product_arr    = [];
            if (!empty($receive) && !empty($product_code)) {
                foreach ($product_code as $key => $v) {
                    $amnt = $amount[$key];
                    $product_arr[] = [
                        'receive_code'  => $receive_code,
                        'product_code'  => $v,
                        'amount'        => $amnt
                    ];

                    // Update amount
                    $product = Product::where('code', $v)->first();
                    $product->stock_store = $product->stock_store + $amnt;
                    $product->save();
                }

                DB::table('tr_receive_detail')->insert($product_arr);
            }
            Alert::success('Add Receive', 'Success');
            // dd($request->all());
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('receive.index');
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
