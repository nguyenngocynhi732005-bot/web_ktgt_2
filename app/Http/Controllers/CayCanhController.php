<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CayCanhController extends Controller
{
    private function buildProductsQuery(?int $categoryId = null, ?string $sort = null)
    {
        $query = DB::table('san_pham as sp')
            ->select('sp.*')
            ->where('sp.status', 1);

        if ($categoryId !== null) {
            $query->join('sanpham_danhmuc as sp_dm', 'sp.id', '=', 'sp_dm.id_san_pham')
                ->where('sp_dm.id_danh_muc', $categoryId)
                ->distinct();
        }

        if ($sort === 'dễ-chăm-sóc') {
            $query->where('sp.do_kho', 'like', '%chăm sóc%');
        } elseif ($sort === 'chịu-được-bóng-râm') {
            $query->where(function ($subQuery) {
                $subQuery->where('sp.yeu_cau_anh_sang', 'like', '%râm%')
                    ->orWhere('sp.yeu_cau_anh_sang', 'like', '%thiếu sáng%');
            });
        }

        $query->orderBy('sp.gia_ban', $sort === 'desc' ? 'desc' : 'asc');

        return $query;
    }

    public function index(Request $request): View
    {
        $loaicay = DB::table('danh_muc')->get();
        $sort = $request->query('sort');
        $cay = $this->buildProductsQuery(null, $sort)->limit(20)->get();

        return view('caycanh.index', compact('loaicay', 'cay'));
    }

    public function product(int $id, ?string $sort = null): View
    {
        $loaicay = DB::table('danh_muc')->get();
        $cay = $this->buildProductsQuery($id, $sort)->get();

        return view('caycanh.index', compact('loaicay', 'cay'));
    }

    public function detail(int $id): View
    {
        $loaicay = DB::table('danh_muc')->get();
        $sanpham = SanPham::with('danhMucs')
            ->where('status', 1)
            ->findOrFail($id);

        return view('caycanh.detail', compact('loaicay', 'sanpham'));
    }

    public function addToCart(Request $request, int $id): RedirectResponse
    {
        $quantity = max(1, (int) $request->input('quantity', 1));
        $sanpham = SanPham::where('status', 1)->findOrFail($id);

        $cart = session('cart', []);
        $key = (string) $id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $quantity;
        } else {
            $cart[$key] = [
                'id' => $sanpham->id,
                'name' => $sanpham->ten_san_pham,
                'price' => (float) $sanpham->gia_ban,
                'qty' => $quantity,
                'image' => $sanpham->hinh_anh,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    public function cartDelete(Request $request): RedirectResponse
    {
        $id = (string) $request->input('id');
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clearCart(): RedirectResponse
    {
        session()->forget('cart');

        return back()->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }
}
