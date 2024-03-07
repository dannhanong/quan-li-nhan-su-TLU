<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kiluat extends Model
{
    use HasFactory;
    protected $fillable = [
        'maKiLuat',
        'tenKiLuat'
    ];
}
