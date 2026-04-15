@extends('layouts.app')

@section('content')

<style>
.container-detail{
    max-width:1100px;
    margin:20px auto;
    background:#fff;
    padding:20px;
    border-radius:10px;
}

/* layout */
.detail-box{
    display:flex;
    gap:30px;
}

/* ảnh */
.detail-img-box{
    width:40%;
}

.detail-img-box img{
    width:100%;
    border-radius:10px;
}

/* info */
.detail-info{
    width:60%;
}

.title{
    font-size:22px;
    font-weight:bold;
}

.price{
    color:red;
    font-size:22px;
    font-weight:bold;
    margin:10px 0;
}

.info p{
    margin:6px 0;
    font-size:14px;
}

.tag{
    display:inline-block;
    background:#eee;
    padding:4px 8px;
    margin-right:5px;
    border-radius:5px;
    font-size:13px;
}

/* mua hàng */
.buy-box{
    margin-top:15px;
    display:flex;
    gap:10px;
}

.buy-box input{
    width:60px;
    padding:5px;
}

.btn{
    background:#28a745;
    color:white;
    padding:10px 15px;
    border:none;
    border-radius:5px;
}

/* mô tả */
.desc{
    margin-top:20px;
    font-size:14px;
    line-height:1.6;
}
</style>

<div class="container-detail">

    <!-- breadcrumb -->
    <div style="color:#888;font-size:14px;margin-bottom:10px;">
        Trang chủ / Cây cảnh / {{ $sanpham->ten_san_pham }}
    </div>

    <div class="detail-box">

        <!-- LEFT IMAGE -->
        <div class="detail-img-box">
            <img src="{{ asset('storage/image/'.$sanpham->hinh_anh) }}">
        </div>

        <!-- RIGHT INFO -->
        <div class="detail-info">

            <div class="title">
                {{ $sanpham->ten_san_pham }}
            </div>

            <div class="price">
                {{ number_format($sanpham->gia_ban, 0, ',', '.') }} đ
            </div>

            <div class="info">
                <p><b>Tên khoa học:</b> {{ $sanpham->ten_khoa_hoc }}</p>
                <p><b>Tên thường:</b> {{ $sanpham->ten_thong_thuong }}</p>
                <p><b>Độ khó:</b> {{ $sanpham->do_kho }}</p>
                <p><b>Ánh sáng:</b> {{ $sanpham->yeu_cau_anh_sang }}</p>
                <p><b>Nước:</b> {{ $sanpham->nhu_cau_nuoc }}</p>
            </div>

            <div style="margin-top:10px;">
                <b>Danh mục:</b><br>
                @foreach($danhmucs as $dm)
                    <span class="tag">{{ $dm->ten_danh_muc }}</span>
                @endforeach
            </div>

            <form class="buy-box">
                <input type="number" value="1" min="1">
                <button class="btn">Thêm vào giỏ hàng</button>
            </form>

        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="desc">
        <b>Mô tả:</b><br>
        {{ $sanpham->mo_ta }}
    </div>

</div>

@endsection