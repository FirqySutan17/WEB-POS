<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosingDate extends Model
{
    use HasFactory;
    protected $table = 'cl_date';
    protected $fillable = ['start_date', 'end_date'];
}
