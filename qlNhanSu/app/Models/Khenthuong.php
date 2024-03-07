<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khenthuong extends Model
{
    use HasFactory;
    protected $fillable = [
        'Manhansu',
        'ngayKhenThuong',
        'lyDo',
        'chiTietKhenThuong'
    ];
}
