<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleUpload extends Model
{
    use HasFactory;
    protected $table = 'single_upload';
    use Blameable;
    protected $fillable = ['title', 'description', 'image'];
    public $timestamps = false;

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
