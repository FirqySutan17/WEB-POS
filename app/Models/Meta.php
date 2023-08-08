<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;
    protected $table = 'meta';
    use Blameable;
    protected $fillable = ['name', 'slug', 'meta_title', 'meta_description', 'meta_keyword', 'meta_robots', 'og_title', 'og_site_name', 'og_description', 'og_url', 'og_image', 'og_image_width', 'og_image_height', 'og_type', 'og_locale', 'og_alternate', 'twitter_card', 'twitter_title', 'twitter_description', 'twitter_image', 'twitter_creator', 'twitter_site', 'schema_markup'];

    public function scopeSearch($query, $title)
    {
        return $query->where('name', 'LIKE', "%{$title}%");
    }

    public function scopePublish($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDraft($query)
    {
        return $query->where('is_active', 0);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
