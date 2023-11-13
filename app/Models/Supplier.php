<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Supplier extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'suppliers';
    protected $fillable = ['supplier_code', 'name', 'phone', 'email', 'address'];

    public function receives()
    {
        return $this->hasMany(ReceiveMaterial::class);
    }

    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
