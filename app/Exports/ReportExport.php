<?php

namespace App\Exports;

use App\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    public function __construct($data, $blade, $sdate = "", $edate = "")
    {
        $this->data = $data;
        $this->blade = $blade;
        $this->sdate = $sdate;
        $this->edate = $edate;
    }

    public function view(): View
    {
        return view('exports.'.$this->blade, [
            'data'  => $this->data,
            'sdate' => $this->sdate,
            'edate' => $this->edate 
        ]);
    }
}