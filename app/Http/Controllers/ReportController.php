<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report_stock() {
        return view('admin.report.stock');
    }

    public function report_transaction() {
        return view('admin.report.transaction');
    }
}
