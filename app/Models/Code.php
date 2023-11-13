<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Code extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'mst_code';
    protected $fillable = ['head', 'code_name'];

    public function commons()
    {
        return $this->hasMany(CommonCode::class);
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('code_name', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
