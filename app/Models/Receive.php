<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Receive extends Model
{
    use HasFactory;
    protected $table = 'tr_receive';
    use Blameable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['receive_code', 'receive_date', 'delivery_no', 'delivery_file', 'plate_no', 'driver', 'driver_phone', 'is_warehouse'];
        // public $timestamps = false;


    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function details()
    {
        return $this->hasMany(ReceiveDetail::class, 'receive_code');
    }
}
