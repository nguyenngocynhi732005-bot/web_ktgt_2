<x-cay-canh-layout>
    <x-slot name="title">Danh sách Cây Cảnh</x-slot>

    <div class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert-success">
                    <strong>✓ Thành công!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="section-title">QUẢN LÝ SẢN PHẨM</div>

            <div class="toolbar">
                <button class="btn-add">+ Thêm</button>
            </div>

            <div class="table-container">
                <table id="productsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên khoa học</th>
                            <th>Tên thương hiệu</th>
                            <th>Độ khó</th>
                            <th>Yêu cầu ánh sáng</th>
                            <th>Nhu cầu nước</th>
                            <th>Giá bán</th>
                            <th>Ảnh</th>
                            <th>Thao tác</th>
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
                                <td class="price">{{ number_format($item->gia_ban ?? 0, 0, ',', '.') }}<span style="font-size: 12px;">.00</span></td>
                                <td style="text-align: center;">
                                    <img src="{{ asset('storage/image/' . ($item->hinh_anh ?? 'default.jpg')) }}" 
                                         alt="{{ $item->ten_san_pham ?? 'Product' }}" 
                                         class="product-image"
                                         onerror="this.src='{{ asset('library/default-product.png') }}'">
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
                                <td colspan="9" class="empty-state">
                                    <i class="fa fa-leaf" style="font-size: 48px; margin-bottom: 15px; display: block; color: #ddd;"></i>
                                    <p>Chưa có dữ liệu sản phẩm cây cảnh</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .main-content {
            padding: 30px 0;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: #1e88e5;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            gap: 1px;
        }

        .btn-add {
            background: #27a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-add:hover {
            background: #20c997;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 20px;
        }

        #productsTable {
            width: 100% !important;
        }

        #productsTable thead {
            background: linear-gradient(to right, #f0f4f8, #e8eef5);
            border-top: 2px solid #27a745;
        }

        #productsTable thead th {
            color: #333;
            font-weight: 700;
            padding: 15px 10px;
            text-align: center;
            font-size: 14px;
            border: none;
        }

        #productsTable tbody td {
            padding: 12px 10px;
            border: 1px solid #f0f0f0;
            text-align: left;
            font-size: 13px;
        }

        #productsTable tbody tr {
            transition: background 0.3s;
        }

        #productsTable tbody tr:hover {
            background-color: #f9f9f9;
        }

        .product-image {
            max-width: 60px;
            height: 60px;
            border-radius: 5px;
            border: 1px solid #ddd;
            object-fit: cover;
        }

        .price {
            font-weight: 700;
            font-size: 14px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-view {
            background: #1e88e5;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-view:hover {
            background: #1565c0;
            color: white;
            text-decoration: none;
        }

        .btn-delete {
            background: #e74a3b;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-delete:hover {
            background: #d63d2d;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <script src="{{ asset('library/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('library/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>

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
                    search: "Tìm kiếm:",
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