<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class ProjectType extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'project_type';
    protected $fillable = ['name', 'slug', 'is_active'];

    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
