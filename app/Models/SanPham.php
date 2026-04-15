<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_pham';

    public $timestamps = false;

    protected $fillable = [
        'ten_san_pham',
        'gia_ban',
        'hinh_anh',
        'mo_ta',
        'ten_khoa_hoc',
        'ten_thong_thuong',
        'do_kho',
        'yeu_cau_anh_sang',
        'nhu_cau_nuoc'
    ];

    public function danhMucs()
    {
        return $this->belongsToMany(
            DanhMuc::class,
            'sanpham_danhmuc',
            'id_san_pham',
            'id_danh_muc'
        );
    }
}