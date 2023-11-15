<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class ReceiveMaterial extends Model
{
    use HasFactory;
    protected $table = 'receive_material';
    use Blameable;
    protected $fillable = ['no_po', 'plant', 'date_po', 'time_po', 'supplier_id', 'top_days', 'top_category', 'top_date', 'delivery_time', 'delivery_place', 'remarks', 'is_tax', 'is_po', 'grand_qty', 'grand_amount', 'grand_total_max', 'grand_total_amount'];
        // public $timestamps = false;


    public function scopeSearch($query, $title)
    {
        return $query->where('no_po', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
