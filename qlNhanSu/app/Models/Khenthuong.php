<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khenthuong extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'Manhansu',
        'ngayKhenThuong',
        'lyDo',
        'chiTietKhenThuong'
    ];
}
