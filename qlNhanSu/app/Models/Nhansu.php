<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhansu extends Model
{
    use HasFactory;
    protected $fillable = [
        'Manhansu',
        'Hoten',
        'Ngaysinh',
        'Gioitinh',
        'CCCD',
        'Ngaybatdau',
        'Diachi',
        'SDT',
        'Quequan',
        'Maphongban',
        'MaChucVu',
        'Makhoa',
        'Bacluong',
        'Anhdaidien',
        'email'
    ];

    public function phongban()
    {
        return $this->belongsTo(Phongban::class, 'MaPhongBan', 'id');
    }
}
