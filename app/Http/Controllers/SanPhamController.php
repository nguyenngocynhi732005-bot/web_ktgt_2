<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SanPhamController extends Controller
{
    public function create() 
    {
        $action = "add";
        $loaicay = DB::table('danh_muc')->get();
        
        // Khởi tạo một object rỗng để View add.blade.php không bị lỗi thiếu biến
        $sanpham = new \stdClass();
        $sanpham->code = "";
        $sanpham->ten_san_pham = "";
        $sanpham->gia_ban = "";
        $sanpham->ten_khoa_hoc = "";
        $sanpham->ten_thong_thuong = "";
        $sanpham->quy_cach_san_pham = "";
        $sanpham->do_kho = "";
        $sanpham->yeu_cau_anh_sang = "";
        $sanpham->nhu_cau_nuoc = "";
        $sanpham->mo_ta = "";
        $sanpham->hinh_anh = "";
        
        // Truyền cả $action và $sanpham sang View
        return view("sanpham.add", compact("action", "sanpham", "loaicay")); 
    }

    public function save($action, Request $request) {
    // 1. Kiểm tra (Validate) dữ liệu người dùng nhập
    $request->validate([
        'ten_san_pham' => ['required', 'string', 'max:200'],
        'gia_ban'      => ['required'],
        'hinh_anh'     => ['nullable', 'image']
    ], [
        'required' => ':attribute không được để trống.',
        'string' => ':attribute phải là chuỗi ký tự.',
        'max' => ':attribute không được vượt quá :max ký tự.',
        'image' => ':attribute phải là tệp hình ảnh hợp lệ (jpg, png, webp...).',
    ], [
        'ten_san_pham' => 'Tên sản phẩm',
        'gia_ban' => 'Giá bán',
        'hinh_anh' => 'Ảnh',
    ]);

    $data = $request->only([
        'ten_san_pham',
        'gia_ban',
        'mo_ta',
        'ten_khoa_hoc',
        'ten_thong_thuong',
        'quy_cach_san_pham',
        'do_kho',
        'yeu_cau_anh_sang',
        'nhu_cau_nuoc',
    ]);

    if($request->hasFile("hinh_anh")) {
        // Đặt lại tên file tránh trùng lặp
        $fileName = "sp_" . rand(1000000, 9999999) . '.' . $request->file('hinh_anh')->extension();
        
        $request->file('hinh_anh')->storeAs('public/image', $fileName);
        
        $data['hinh_anh'] = $fileName;
    }

    $message = "";
    
    // 4. Insert vào database nếu action là add
    if($action == "add") {
            try {
                // Cột code là NOT NULL trong DB, tự sinh nếu form không gửi lên.
                $data['code'] = $request->input('code') ?: ('SP' . now()->format('YmdHis') . rand(10, 99));

                // Gán status = 1 để sản phẩm có thể hiển thị (Yêu cầu số 7)
                $data['status'] = 1; 

                DB::table("san_pham")->insert($data);
                
                return redirect()->route('quanlysanpham')->with('status', 'Thêm sản phẩm thành công!');
            
            } catch (\Exception $e) {
                return back()->withInput()->withErrors([
                    'db_error' => 'Lỗi lưu dữ liệu: ' . $e->getMessage(),
                ]);
            }
        }

    return redirect()->route('quanlysanpham')->with('status', $message); 
    }
}




