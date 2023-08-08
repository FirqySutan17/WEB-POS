<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = 'portfolio';
    use Blameable;
    protected $fillable = ['client_name', 'slug', 'project_title', 'link', 'description', 'description_2', 'start_year', 'end_year', 'is_active'];
    public $timestamps = false;

    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }

    public function imagesliders()
    {
        return $this->hasMany(PortfolioSlider::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'portfolio_skill');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
