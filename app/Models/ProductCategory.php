<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = ['categories', 'slug'];

    public function scopeSearch($query, $title)
    {
        return $query->where('categories', 'LIKE', "%{$title}%");
    }

}
