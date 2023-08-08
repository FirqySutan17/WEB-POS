<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Exception;

class PortfolioController extends Controller
{
    public function all(Request $request) {
        $id = $request->input('id');
        $limit = $request->input('limit', 100);
        $name = $request->input('name');

        if($id) {
            $portfolio = Portfolio::with(['images', 'imagesliders', 'skills'])->find($id);

            if($portfolio) {
                return ResponseFormatter::success($portfolio, 'Data portfolio berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data portfolio tidak ada', 404);
            }
        }

        $portfolio = Portfolio::with(['imagesliders', 'skills', 'images']);
        
        if($name) {
            $portfolio->where('name', 'like', '%' . $name . '%');
        }
        
        return ResponseFormatter::success(
            $portfolio->where('is_active', '=', 1)->get(), 'Data list portfolio berhasil diambil'
        );
    }

    public function show($slug)
    {
        $portfolios = Portfolio::with(['images', 'imagesliders', 'skills'])->where('slug', $slug)->first();
        if ($portfolios) {
          return response()->json(['data' => $portfolios]);
        } else {
          return response()->json(['status' => 'DATA_NOT_FOUND', 'data' => []]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
