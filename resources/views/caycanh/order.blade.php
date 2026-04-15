<x-cay-canh-layout :loaicay="$loaicay ?? []">
    <x-slot name="title">Giỏ hàng</x-slot>
    <div style="padding: 16px 10px;">
        <h3 style="text-align:center; margin-bottom: 14px; color: #1160a1;">Danh sách sản phẩm</h3>

        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        @php
            $tongTien = 0;
        @endphp

        @if(count($cart) > 0)
            <table class="table table-bordered" style="background:#fff;">
                <thead>
                    <tr>
                        <th style="width:60px;">STT</th>
                        <th>Sản phẩm</th>
                        <th style="width:110px;">Số lượng</th>
                        <th style="width:140px;">Đơn giá</th>
                        <th style="width:140px;">Thành tiền</th>
                        <th style="width:100px;">Xóa</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach($cart as $id => $item)
                        @php
                            $thanhTien = ($item['price'] ?? 0) * ($item['qty'] ?? 0);
                            $tongTien += $thanhTien;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <span>{{ $item['name'] ?? 'Caycanh' }}</span>
                                </div>
                            </td>
                            <td>{{ $item['qty'] ?? 0 }}</td>
                            <td>{{ number_format($item['price'] ?? 0, 0, ',', '.') }}d</td>
                            <td>{{ number_format($thanhTien, 0, ',', '.') }}d</td>
                            <td>
                                <form method="post" action="{{ route('cartdelete') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align:center;"><b>Tổng cộng</b></td>
                        <td><b>{{ number_format($tongTien, 0, ',', '.') }}d</b></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align:center; margin-top: 12px;">
                <form method="post" action="{{ route('ordercreate') }}">
                    @csrf
                    <label for="hinh_thuc_thanh_toan" style="margin-right:8px; font-weight:bold;">Hình thức thanh toán</label><br>
                    <select id="hinh_thuc_thanh_toan" name="hinh_thuc_thanh_toan" class="form-control form-control-sm" style="display:inline-block; width:220px;">
                        <option value="1">Tiền mặt</option>
                        <option value="2">Chuyển khoản</option>
                        <option value="3">Thanh toán VNPay</option>
                    </select><br>
                    <button type="submit" class="btn btn-primary btn-sm" style="margin-left:8px; margin-top:10px;">Đặt hàng</button>
                </form>
            </div>
        @else
            <p style="text-align:center;">Giỏ hàng đang trống.</p>
        @endif
    </div>
</x-cay-canh-layout>
