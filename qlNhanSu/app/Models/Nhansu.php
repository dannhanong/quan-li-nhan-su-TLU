<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nhansu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
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
        'Chucvu_Cu',
        'Makhoa',
        'Hesoluong',
        'Bacluong',
        'Anhdaidien',
        'email',
        'Matrangthai',
        'deleted_at'
    ];

    public function phongban()
    {
        return $this->belongsTo(Phongban::class, 'MaPhongBan', 'id');
    }
}
