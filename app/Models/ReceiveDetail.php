<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveDetail extends Model
{
    use HasFactory;
    protected $table = 'tr_receive_detail';
    use Blameable;
    protected $fillable = ['receive_code', 'product_code', 'amount'];


    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'code', 'product_code');
    }
}
