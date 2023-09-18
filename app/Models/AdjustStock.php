<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustStock extends Model
{
    // use HasFactory;
    protected $table = 'tr_adjust_stock';
    protected $fillable = ['date', 'time', 'employee_id', 'product_code', 'type', 'qty', 'remark', 'approval'];
    // public $timestamps = false;

    public function scopeSearch($query, $title)
    {
        return $query->where('product_code', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'code');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'employee_id');
    }

    public function user_approval()
    {
        return $this->belongsTo(User::class, 'approval', 'pin');
    }
}
