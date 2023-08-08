<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioSlider extends Model
{
    use HasFactory;
    protected $table = 'portfolio_slider';
    use Blameable;
    protected $fillable = ['portfolio_id', 'image_slider', 'alt_text_slider', 'hover_text_slider'];
        public $timestamps = false;


    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
