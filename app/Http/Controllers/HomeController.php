<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

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

    //
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
}
