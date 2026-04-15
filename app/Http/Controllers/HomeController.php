<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SanPham;

class HomeController extends Controller
{
    private function buildProductsQuery(?int $categoryId = null, ?string $sort = null)
    {
        $query = DB::table('san_pham as sp')->select('sp.*');

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

    public function index()
    {
        $loaicay = DB::select("select * from danh_muc");
        $sort = request('sort');
        $cay = $this->buildProductsQuery(null, $sort)->limit(20)->get();

        return view("caycanh.index", compact('loaicay', 'cay'));
    }

    public function product($id, $sort = null)
    {
        $loaicay = DB::select("select * from danh_muc");
        $cay = $this->buildProductsQuery((int) $id, $sort)->get();

        return view("caycanh.index", compact('loaicay', 'cay'));
    }

    public function search(Request $request)
    {
        $keyword = trim((string) $request->input('keyword', ''));
        $loaicay = DB::select('select * from danh_muc');

        $query = DB::table('san_pham as sp')
            ->select('sp.*')
            ->where('sp.status', 1);

        if ($keyword !== '') {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('sp.ten_san_pham', 'like', "%{$keyword}%")
                    ->orWhere('sp.ten_khoa_hoc', 'like', "%{$keyword}%")
                    ->orWhere('sp.ten_thong_thuong', 'like', "%{$keyword}%")
                    ->orWhere('sp.mo_ta', 'like', "%{$keyword}%")
                    ->orWhere('sp.quy_cach_san_pham', 'like', "%{$keyword}%")
                    ->orWhere('sp.do_kho', 'like', "%{$keyword}%")
                    ->orWhere('sp.yeu_cau_anh_sang', 'like', "%{$keyword}%")
                    ->orWhere('sp.nhu_cau_nuoc', 'like', "%{$keyword}%");
            });
        }

        $cay = $query->orderBy('sp.id', 'desc')->get();

        return view('caycanh.index', compact('loaicay', 'cay', 'keyword'));
    }
}
