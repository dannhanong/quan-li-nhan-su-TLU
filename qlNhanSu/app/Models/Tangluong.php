<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tangluong extends Model
{
    use HasFactory;
    protected $fillable = [
        'maTangLuong'
        ,'lidotangluong'
        ,'ngaytangluong'
        ,'mans'
        ,'chitiettangluong'
    ];
}
