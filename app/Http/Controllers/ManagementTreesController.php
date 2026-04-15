<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SanPham;

class ManagementTreesController extends Controller
{
    // 1. Hiển thị danh sách 
    public function index()
{
    $categories = DB::table('danh_muc')->get();
    $caycanh = SanPham::where('status', 1)->orderBy('id', 'DESC')->get();

    // Truyền thêm title vào đây
    return view('caycanh.caycanh_list', [
        'caycanh' => $caycanh,
        'categories' => $categories,
        'brand' => $categories,
        'title' => 'Danh sách Cây Cảnh'
    ]);
}

    public function show($id)
    {
        $caycanh = SanPham::where('status', 1)->findOrFail($id);
        
        $brand = DB::table('danh_muc')->get();
        
        return view('caycanh.detail', compact('caycanh', 'brand'));
    }

    // 3. Xử lý xóa mềm (Cập nhật status về 0)
    public function destroy($id)
    {
        $caycanh = SanPham::findOrFail($id);
        $caycanh->update(['status' => 0]);
        return redirect()->route('caycanh.index')->with('success', 'Đã xóa sản phẩm thành công!');
    }
}
