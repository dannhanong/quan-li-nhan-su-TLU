<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trangthai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'maTrangThai',
        'tenTrangThai'
    ];
}
