<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductExport implements FromView
{
    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Product::with(['supplier', 'creator', 'updater']);

        // Filter by keyword
        if ($this->request->get('keyword')) {
            $query->search($this->request->keyword);
        }

        // Filter by status
        if ($this->request->has('status') && $this->request->status !== '') {
            if ($this->request->status == '1') {
                $query->where('is_active', 1);
            } elseif ($this->request->status == '0') {
                $query->where('is_active', 0);
            }
        }

        $products = $query->orderBy('id', 'desc')->get();

        return view('admin.product.export_excel', [
            'products' => $products
        ]);
    }
}
