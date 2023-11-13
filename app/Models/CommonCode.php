<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class CommonCode extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'mst_common_code';
    protected $fillable = ['head_id', 'code', 'name', 'description', 'is_active'];

    public function code_head()
    {
        return $this->belongsTo(Code::class, 'head_id', 'id');
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
