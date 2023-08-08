<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MetaPage extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $table = 'page_metas';
    protected $fillable = ['name', 'slug'];
    public $translatedAttributes = ['page_name', 'page_slug', 'meta_title', 'meta_description', 'meta_keyword', 'meta_robots', 'og_title', 'og_site_name', 'og_description', 'og_url', 'og_image', 'og_image_width', 'og_image_height', 'og_image_type', 'og_type', 'og_locale', 'og_locale_alternate', 'twitter_card', 'twitter_title', 'twitter_description', 'twitter_image', 'twitter_creator', 'twitter_site', 'schema_markup'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
