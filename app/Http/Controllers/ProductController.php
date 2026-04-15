<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\SanPham;

class ProductController extends Controller
{
    public function detail($id)
    {
        $loaicay = DB::select("select * from danh_muc");
        $sanpham = SanPham::with('danhMucs')->findOrFail($id);

        return view('caycanh.detail', compact('loaicay', 'sanpham'));
    }
}
