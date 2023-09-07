<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductPriceLog extends Model
{
    use HasFactory;
    protected $table = 'products_price_log';
    use Blameable;
    protected $fillable = ['product_code', 'price_store', 'price_olshop', 'discount_store', 'discount_olshop', 'is_vat'];
        // public $timestamps = false;


    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
