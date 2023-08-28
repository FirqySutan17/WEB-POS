<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'tr_transaction_detail';

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'invoice_no', 'invoice_no');
    }
}
