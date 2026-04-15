<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:san_pham,id',
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $sanpham = SanPham::findOrFail($validated['product_id']);
        $cart = session()->get('cart', []);

        if (isset($cart[$sanpham->id])) {
            $cart[$sanpham->id]['so_luong'] += (int) $validated['quantity'];
        } else {
            $cart[$sanpham->id] = [
                'id' => $sanpham->id,
                'ten_san_pham' => $sanpham->ten_san_pham,
                'gia_ban' => $sanpham->gia_ban,
                'hinh_anh' => $sanpham->hinh_anh,
                'so_luong' => (int) $validated['quantity'],
            ];
        }

        session()->put('cart', $cart);

        $totalQuantity = collect($cart)->sum(function ($item) {
            return (int) ($item['so_luong'] ?? $item['quantity'] ?? 0);
        });

        return response()->json([
            'message' => 'Thêm vào giỏ hàng thành công',
            'totalQuantity' => $totalQuantity,
        ]);
    }
}
