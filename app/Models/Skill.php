<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class Skill extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'skill';
    protected $fillable = ['name', 'slug', 'image', 'is_active'];

    public function careers()
    {
        return $this->belongsToMany(Career::class, 'career_skill');
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
