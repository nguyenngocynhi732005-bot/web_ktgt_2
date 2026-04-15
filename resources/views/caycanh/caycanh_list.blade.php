<x-cay-canh-layout :loaicay="$categories ?? []">
    <x-slot name="title">Danh sách Cây Cảnh</x-slot>

    <div class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert-success">
                    <strong>Thành công!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="section-title">QUẢN LÝ SẢN PHẨM</div>

            <div class="toolbar">
                <button class="btn-add">Thêm</button>
            </div>

            <div class="table-container">
                <table id="productsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên khoa học</th>
                            <th>Tên thông thường</th>
                            <th>Độ khó</th>
                            <th>Yêu cầu ánh sáng</th>
                            <th>Nhu cầu nước</th>
                            <th>Giá bán</th>
                            <th>Ảnh</th>
                            <th>Thao tac</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($caycanh as $item)
                            <tr>
                                <td><strong>{{ $item->ten_san_pham ?? 'N/A' }}</strong></td>
                                <td>{{ $item->ten_khoa_hoc ?? 'N/A' }}</td>
                                <td>{{ $item->ten_thong_thuong ?? 'N/A' }}</td>
                                <td>{{ $item->do_kho ?? 'N/A' }}</td>
                                <td>{{ $item->yeu_cau_anh_sang ?? 'N/A' }}</td>
                                <td>{{ $item->nhu_cau_nuoc ?? 'N/A' }}</td>
                                <td class="price">{{ number_format($item->gia_ban ?? 0, 0, ',', '.') }}<span class="currency">.00</span></td>
                                <td class="image-col">
                                    <img src="{{ asset('storage/image/' . ($item->hinh_anh ?? 'default.jpg')) }}"
                                         alt="{{ $item->ten_san_pham ?? 'Product' }}"
                                         class="product-image"
                                         data-fallback="{{ asset('library/default-product.png') }}"
                                         onerror="this.onerror=null;this.src=this.dataset.fallback;">
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('caycanh.show', $item->id) }}" class="btn-view">Xem</a>
                                        <form action="{{ route('caycanh.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-state">Chua co du lieu san pham cay canh</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .main-content {
            padding: 12px 0;
            background: #ffffff;
        }

        .container {
            max-width: 920px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            color: #1976d2;
            margin: 0 0 10px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .toolbar {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 8px;
        }

        .btn-add {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 6px 18px;
            border-radius: 3px;
            font-weight: 700;
            cursor: pointer;
            font-size: 16px;
            line-height: 1.1;
        }

        .btn-add:hover {
            background: #23913a;
        }

        .table-container {
            background: transparent;
            border-radius: 0;
            box-shadow: none;
            padding: 0;
        }

        #productsTable {
            width: 100% !important;
            background: #fff;
            border: 1px solid #d6d9dd;
            margin-bottom: 0;
        }

        #productsTable thead th {
            color: #1f2933;
            font-weight: 700;
            padding: 12px 14px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #d6d9dd;
            vertical-align: middle;
           
        }

        #productsTable thead th.sorting,
        #productsTable thead th.sorting_asc,
        #productsTable thead th.sorting_desc,
        #productsTable thead th[class*="dt-orderable"],
        #productsTable thead th[class*="dt-ordering"] {
            padding-right: 30px !important;
            background-position: right 10px center !important;
        }

        #productsTable thead th .dt-column-order {
            margin-left: 8px;
        }

        #productsTable tbody td {
            padding: 8px 10px;
            border: 1px solid #d6d9dd;
            text-align: left;
            font-size: 13px;
            line-height: 1.35;
            vertical-align: top;
            color: black;
            background: #f3f3f3;
        }

        #productsTable tbody tr:nth-child(even) td {
            background: #ffffff;
        }

        #productsTable tbody tr:hover td {
            background: #eceff2;
        }

        .image-col {
            text-align: center;
            vertical-align: middle;
        }

        .product-image {
            width: 42px;
            height: 42px;
            border-radius: 3px;
            border: 1px solid #c8ccd1;
            object-fit: cover;
        }

        .price {
            font-weight: 700;
            font-size: 14px;
            white-space: nowrap;
        }

        .currency {
            font-size: 12px;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            justify-content: center;
            align-items: center;
        }

        .btn-view,
        .btn-delete {
            color: #fff;
            border: none;
            padding: 4px 9px;
            border-radius: 2px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            line-height: 1.4;
        }

        .btn-view {
            background: #0d6efd;
        }

        .btn-view:hover {
            background: #0b5ed7;
            color: #fff;
            text-decoration: none;
        }

        .btn-delete {
            background: #dc3545;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 24px;
            color: #666;
            background: #fff;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 10px 14px;
            border-radius: 4px;
            margin-bottom: 12px;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cfd3d8;
            border-radius: 3px;
            padding: 3px 6px;
            background: #fff;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 13px;
            margin-top: 8px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#productsTable').DataTable({
                responsive: false,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                stateSave: true,
                pagingType: 'simple_numbers',
                columnDefs: [
                    { orderable: false, targets: [7, 8] }
                ],
                language: {
                    lengthMenu: "_MENU_ entries per page",
                    search: "Search:",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        previous: "«",
                        next: "»"
                    },
                    emptyTable: "Không có dữ liệu"
                }
            });
        });
    </script>
</x-cay-canh-layout>
