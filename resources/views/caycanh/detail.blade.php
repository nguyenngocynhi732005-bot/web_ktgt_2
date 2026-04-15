<x-cay-canh-layout :loaicay="$loaicay">
    <x-slot name="title">
        {{ $sanpham->ten_san_pham }}
    </x-slot>

    <style>
        .container-detail {
            max-width: 1100px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .detail-box {
            display: flex;
            gap: 30px;
        }

        .detail-img-box {
            width: 40%;
        }

        .detail-img-box img {
            width: 100%;
            border-radius: 10px;
        }

        .detail-info {
            width: 60%;
        }

        .title {
            font-size: 22px;
            font-weight: 400;
        }

        .price .amount {
            color: #e74c3c;
            font-style: italic;
            margin-left: 5px;
        }

        .info p {
            margin: 6px 0;
            font-size: 14px;
        }

        .tag {
            display: inline-block;
            background: #eee;
            padding: 4px 8px;
            margin-right: 5px;
            border-radius: 5px;
            font-size: 13px;
        }

        .buy-box {
            margin-top: 15px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .buy-box input {
            width: 60px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-add {
            background: #28a745;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-add:hover {
            background: #218838;
        }

        .desc {
            margin-top: 20px;
            font-size: 14px;
            line-height: 1.6;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }

        .breadcrumb {
            color: #888;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .breadcrumb a {
            color: #0066cc;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container-detail">

        <div class="detail-box">

            <!-- LEFT IMAGE -->
            <div class="detail-img-box">
                <img src="{{ asset('storage/image/'. $sanpham->hinh_anh) }}" alt="{{ $sanpham->ten_san_pham }}">
            </div>

            <!-- RIGHT INFO -->
            <div class="detail-info">

                <div class="title">
                    {{ $sanpham->ten_san_pham }}
                </div>

                <div class="info" style="margin: 10px 0;">
                    @if($sanpham->ten_khoa_hoc)
                    <p style="margin: 2px 0; font-size: 13px;">Tên khoa học:{{ $sanpham->ten_khoa_hoc }}</p>
                    @endif
                    @if($sanpham->ten_thong_thuong)
                    <p style="margin: 2px 0; font-size: 13px;">Tên thường: {{ $sanpham->ten_thong_thuong }}</p>
                    @endif
                </div>

                @if($sanpham->mo_ta)
                <p style="font-size: 13px; line-height: 1.5; color: #333; margin: 8px 0;">
                    {!! nl2br(e($sanpham->mo_ta)) !!}
                </p>
                @endif

                @if($sanpham->quy_cach_san_pham)
                <p style="font-size: 13px; margin: 8px 0;">Quy cách sản phẩm: {{ $sanpham->quy_cach_san_pham }}</p>
                @endif

                <div class="info" style="margin: 8px 0;">
                    @if($sanpham->do_kho)
                    <p style="margin: 3px 0; font-size: 13px;">Độ khó:{{ $sanpham->do_kho }}</p>
                    @endif
                    @if($sanpham->yeu_cau_anh_sang)
                    <p style="margin: 3px 0; font-size: 13px;">Yêu cầu ánh sáng: {{ $sanpham->yeu_cau_anh_sang }}</p>
                    @endif
                    @if($sanpham->nhu_cau_nuoc)
                    <p style="margin: 3px 0; font-size: 13px;">Nhu cầu nước: {{ $sanpham->nhu_cau_nuoc }}</p>
                    @endif
                </div>

                <div class="price">
                    Giá: <span class="amount">{{ number_format($sanpham->gia_ban, 0, ',', '.') }} VNĐ</span>
                </div>

                <div class="buy-box">
                    <span style="font-size: 13px;">Số lượng mua:</span>
                    <input type="number" id="quantity" value="1" min="1" style="width: 50px;">
                    <button class="btn-add" data-product-id="{{ $sanpham->id }}" onclick="addToCart(this)">Thêm vào giỏ hàng</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        function addToCart(button) {
            const productId = button.getAttribute('data-product-id');
            const quantity = document.getElementById('quantity').value;
            // TODO: Implement add to cart functionality
            alert('Thêm ' + quantity + ' sản phẩm vào giỏ hàng');
        }
    </script>

</x-cay-canh-layout>