<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    use Blameable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['code', 'name', 'description', 'price_store', 'price_olshop', 'stock', 'discount_store', 'discount_olshop', 'is_vat'];
        // public $timestamps = false;


    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%")->orWhere('code', 'LIKE', "%{$title}%");
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
