<?php

namespace App\Exports;

use App\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    public function __construct($data, $blade)
    {
        $this->data = $data;
        $this->blade = $blade;
    }

    public function view(): View
    {
        return view('exports.'.$this->blade, [
            'data' => $this->data
        ]);
    }
}