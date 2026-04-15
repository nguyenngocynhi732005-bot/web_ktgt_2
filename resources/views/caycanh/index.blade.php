<x-cay-canh-layout :loaicay="$loaicay">
    <x-slot name="title">
        Cây cảnh
    </x-slot>

    <div class="sort-toolbar">
        <span style="margin-right:12px; color:#555; font-size:15px; font-weight: 500;">Tìm kiếm theo</span>
        @if(request()->route('id'))
        <a href="{{ url('/loaicay/' . request()->route('id') . '/asc') }}" class="sort-btn">Giá tăng dần</a>
        <a href="{{ url('/loaicay/' . request()->route('id') . '/desc') }}" class="sort-btn">Giá giảm dần</a>
        <a href="{{ url('/loaicay/' . request()->route('id') . '/dễ-chăm-sóc') }}" class="sort-btn">Dễ chăm sóc</a>
        <a href="{{ url('/loaicay/' . request()->route('id') . '/chịu-được-bóng-râm') }}" class="sort-btn">Chịu được bóng râm</a>
        @else
        <a href="{{ url('/loaicay?sort=asc') }}" class="sort-btn">Giá tăng dần</a>
        <a href="{{ url('/loaicay?sort=desc') }}" class="sort-btn">Giá giảm dần</a>
        <a href="{{ url('/loaicay?sort=dễ-chăm-sóc') }}" class="sort-btn">Dễ chăm sóc</a>
        <a href="{{ url('/loaicay?sort=chịu-được-bóng-râm') }}" class="sort-btn">Chịu được bóng râm</a>
        @endif
    </div>

    <div class='list-caycanh'>
<<<<<<< HEAD
        @foreach($cay as $row)
        <a href="{{ url('/sanpham/' . $row->id) }}" style="text-decoration: none; color: inherit;">
            <div class='caycanh'>
                <img src="{{asset('storage/image/'.$row->hinh_anh)}}" width='200px'
                    height='200px'><br>
                <b>{{$row->ten_san_pham}}</b><br />
                <b><i>{{number_format($row->gia_ban,0,",",".")}}đ</i></b>
            </div>
        </a>
        @endforeach
=======
        @forelse($cay as $row)
        <a href="{{ url('/loaicay/' . $row->id) }}" class="caycanh-link" style="text-decoration: none; color: inherit;">
            <div class='caycanh'>
                <img src="{{asset('storage/image/'.$row->hinh_anh)}}" width='200px' height='200px' alt="{{$row->ten_san_pham}}">
                <b>{{$row->ten_san_pham}}</b>
                <b><i>{{number_format($row->gia_ban,0,",",".")}}.000đ</i></b>
            </div>
        </a>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 24px; color: #666;">
            Không tìm thấy sản phẩm cây cảnh nào phù hợp.
        </div>
        @endforelse
>>>>>>> d81e85fdd523ffd5af041adac5d03d51b434b791
    </div>

</x-cay-canh-layout>

<style>
    .sort-toolbar {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        margin: 20px 0 16px;
        flex-wrap: wrap;
        padding: 0 10px;
    }

    .sort-btn {
        padding: 7px 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 13px;
        background: #ffffff;
        color: #666;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        font-weight: 500;
    }

    .sort-btn:hover {
        background: #f5f5f5;
        border-color: #999;
        color: #333;
    }

    .sort-btn:active {
        background: #e8e8e8;
        border-color: #666;
    }

    .list-caycanh {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(175px, 1fr));
        gap: 16px;
        padding: 10px 10px 20px;
        margin-top: 8px;
    }

    .caycanh-link {
        transition: transform 0.2s ease;
    }

    .caycanh-link:hover .caycanh {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .caycanh {
        border: 1px solid #e8e8e8;
        border-radius: 4px;
        padding: 10px;
        text-align: center;
        background: #fff;
        min-height: 240px;
        height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .caycanh img {
        max-height: 140px;
        width: auto;
        margin: 0 auto 12px;
        object-fit: contain;
    }

    .caycanh b {
        display: block;
        font-size: 14px;
        line-height: 1.3;
        margin-bottom: 6px;
        color: #333;
    }

    .caycanh i {
        color: #e53935;
        font-style: italic;
        font-size: 15px;
        font-weight: bold;
    }
</style>