<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SanPham;
class HomeController extends Controller
{
    //
    public function index(){
        return view("caycanh.index");
    }

    //Quỳnh ANh

    public function chiTietSanPham($id)
{
    $sanpham = SanPham::with('danhMucs')->findOrFail($id);

    return view('caycanh.detail', compact('sanpham'));
}
}
