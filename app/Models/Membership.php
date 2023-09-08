<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $table = 'memberships';
    use Blameable;
    protected $fillable = ['code', 'name', 'phone', 'email'];
        // public $timestamps = false;


    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%")->orWhere('code', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}
