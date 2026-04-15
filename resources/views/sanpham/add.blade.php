<x-cay-canh-layout :loaicay="$loaicay ?? []">
    @php
        $isEdit = ($action ?? 'add') !== 'add';
    @endphp

    <x-slot name="title">{{ $isEdit ? 'CHỈNH SỬA' : 'THÊM' }}</x-slot>

    <div class="container mt-3 mb-5 sanpham-page">
        <div class="sanpham-form-wrap mx-auto">
            <h3 class="sanpham-heading text-center mb-4">{{ $isEdit ? 'CHỈNH SỬA' : 'THÊM' }}</h3>

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <form id="edit-form" action="{{ route('sanpham.save', ['action' => $action ?? 'add']) }}" method="post" enctype="multipart/form-data" class="sanpham-form">
                @csrf

                <div class="form-group mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="ten_san_pham" class="form-control" value="{{ old('ten_san_pham', $sanpham->ten_san_pham ?? '') }}">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Tên khoa học</label>
                    <input type="text" name="ten_khoa_hoc" class="form-control" value="{{ old('ten_khoa_hoc', $sanpham->ten_khoa_hoc ?? '') }}">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Tên thông thường</label>
                    <input type="text" name="ten_thong_thuong" class="form-control" value="{{ old('ten_thong_thuong', $sanpham->ten_thong_thuong ?? '') }}">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Quy cách sản phẩm</label>
                    <input type="text" name="quy_cach_san_pham" class="form-control" value="{{ old('quy_cach_san_pham', $sanpham->quy_cach_san_pham ?? '') }}">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="mo_ta" class="form-control form-textarea" rows="4">{{ old('mo_ta', $sanpham->mo_ta ?? '') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Độ khó</label>
                    <input type="text" name="do_kho" class="form-control" value="{{ old('do_kho', $sanpham->do_kho ?? '') }}">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Yêu cầu ánh sáng</label>
                    <input type="text" name="yeu_cau_anh_sang" class="form-control" value="{{ old('yeu_cau_anh_sang', $sanpham->yeu_cau_anh_sang ?? '') }}">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Nhu cầu nước</label>
                    <input type="text" name="nhu_cau_nuoc" class="form-control" value="{{ old('nhu_cau_nuoc', $sanpham->nhu_cau_nuoc ?? '') }}">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Giá bán</label>
                    <input type="text" name="gia_ban" class="form-control" placeholder="Ví dụ: 10000 hoặc 10.000" value="{{ old('gia_ban', $sanpham->gia_ban ?? '') }}">
                </div>

                <div class="form-group mb-4">
                    <label class="form-label">Ảnh</label>
                    <input type="file" name="hinh_anh" id="hinh_anh" class="form-control file-input" accept="image/*">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-save px-4">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .sanpham-page {
            max-width: 900px;
        }

        .sanpham-form-wrap {
            max-width: 460px;
        }

        .sanpham-heading {
            font-size: 16px;
            font-weight: 700;
            color: #2a59b8;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .form-label {
            margin-bottom: 5px;
            color: #333;
            font-weight: 400;
        }

        .sanpham-form .form-control {
            height: 34px;
            border: 1px solid #d9d9d9;
            border-radius: 3px;
            box-shadow: none;
        }

        .sanpham-form .form-control:focus {
            border-color: #7aa6ff;
            box-shadow: 0 0 0 0.12rem rgba(42, 89, 184, 0.12);
        }

        .form-textarea {
            height: auto !important;
            min-height: 72px;
            resize: vertical;
        }

        .file-input {
            padding: 5px 8px;
            background: #fff;
        }

        .btn-save {
            background: #2f7dd6;
            border-color: #2f7dd6;
            min-width: 90px;
            border-radius: 3px;
            font-weight: 600;
        }

        .btn-save:hover {
            background: #2769b5;
            border-color: #2769b5;
        }

        @media (max-width: 576px) {
            .sanpham-form-wrap {
                max-width: 100%;
            }

            .sanpham-heading {
                font-size: 15px;
            }
        }
    </style>
</x-cay-canh-layout>