<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'tr_transaction';
    use SoftDeletes;
    protected $fillable = ['invoice_no', 'receipt_no', 'emp_no', 'trans_date', 'payment_method', 'cash', 'sub_price', 'vat_ppn', 'total_price', 'status', 'cancellation_reason', 'kembalian'];
        // public $timestamps = false;


    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'invoice_no';
    }

    public function detail()
    {
        return $this->hasMany(TransactionDetail::class, 'invoice_no', 'invoice_no');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'emp_no', 'employee_id');
    }

    public function details()
    {
        return $this->hasMany(ReceiveDetail::class, 'receive_code');
    }
}
