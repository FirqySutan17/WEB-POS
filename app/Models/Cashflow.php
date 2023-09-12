<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    use HasFactory;
    protected $table = 'cash_flow';
    use Blameable;
    protected $fillable = ['date', 'time', 'employee_id', 'categories', 'description', 'approval', 'cash'];

    public function scopeSearch($query, $title)
    {
        return $query->where('categories', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'employee_id');
    }
}
