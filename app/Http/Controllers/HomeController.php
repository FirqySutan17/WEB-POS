<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\Post;
use App\Models\User;
use App\Models\Transaction;
use Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::whereDate('trans_date', date('Y-m-d'))->orderBy('trans_date', 'desc')->orderBy('id', 'desc')->with('user')->get();

        $monthly_sales[1] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 1)->sum('total_price'));
        $monthly_sales[2] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 2)->sum('total_price'));
        $monthly_sales[3] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 3)->sum('total_price'));
        $monthly_sales[4] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 4)->sum('total_price'));
        $monthly_sales[5] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 5)->sum('total_price'));
        $monthly_sales[6] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 6)->sum('total_price'));
        $monthly_sales[7] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 7)->sum('total_price'));
        $monthly_sales[8] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 8)->sum('total_price'));
        $monthly_sales[9] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 9)->sum('total_price'));
        $monthly_sales[10] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 10)->sum('total_price'));
        $monthly_sales[11] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 11)->sum('total_price'));
        $monthly_sales[12] = round(Transaction::whereYear('trans_date', date('Y'))->whereMonth('trans_date', 12)->sum('total_price'));
        return view('admin.dashboard.dashboard', compact('transactions', 'monthly_sales'));
    }
}
