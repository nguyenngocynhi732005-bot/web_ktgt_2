<x-cay-canh-layout :loaicay="$loaicay">
    <x-slot name="title">
        Cây cảnh
    </x-slot>

    <div class="sort-toolbar">
        <span style="margin-right:8px; color:#444; font-size:15px;">Tìm kiếm theo</span>
        @if(request()->route('id'))
        <a href="{{ url('/loaicay/' . request()->route('id') . '/asc') }}" class="btn btn-outline-secondary btn-sm sort-btn">Giá tăng dần</a>
        <a href="{{ url('/loaicay/' . request()->route('id') . '/desc') }}" class="btn btn-outline-secondary btn-sm sort-btn">Giá giảm dần</a>
        <a href="{{ url('/loaicay/' . request()->route('id') . '/dễ-chăm-sóc') }}" class="btn btn-outline-secondary btn-sm sort-btn">Dễ chăm sóc</a>
        <a href="{{ url('/loaicay/' . request()->route('id') . '/chịu-được-bóng-râm') }}" class="btn btn-outline-secondary btn-sm sort-btn">Chịu được bóng râm</a>
        @else
        <a href="{{ url('/loaicay?sort=asc') }}" class="btn btn-outline-secondary btn-sm sort-btn">Giá tăng dần</a>
        <a href="{{ url('/loaicay?sort=desc') }}" class="btn btn-outline-secondary btn-sm sort-btn">Giá giảm dần</a>
        <a href="{{ url('/loaicay?sort=dễ-chăm-sóc') }}" class="btn btn-outline-secondary btn-sm sort-btn">Dễ chăm sóc</a>
        <a href="{{ url('/loaicay?sort=chịu-được-bóng-râm') }}" class="btn btn-outline-secondary btn-sm sort-btn">Chịu được bóng râm</a>
        @endif
    </div>

    <div class='list-caycanh'>
        @foreach($cay as $row)
        <div class='caycanh'>
            <img src="{{asset('storage/image/'.$row->hinh_anh)}}" width='200px'
                height='200px'><br>
            <b>{{$row->ten_san_pham}}</b><br />
            <b><i>{{number_format($row->gia_ban,0,",",".")}}đ</i></b>
        </div>
        @endforeach
    </div>

</x-cay-canh-layout>

<style>
    .sort-toolbar {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin: 16px 0 10px;
        flex-wrap: wrap;
    }

    .sort-btn {
        padding: 0.22rem 0.6rem;
        border-radius: 3px;
        font-size: 13px;
        background: #ffffff;
    }

    .list-caycanh {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(175px, 1fr));
        gap: 12px;
        padding: 0 10px 16px;
        margin-top: 8px;
    }

    .caycanh {
        border: 1px solid #e2e2e2;
        border-radius: 3px;
        padding: 8px;
        text-align: center;
        background: #fff;
        min-height: 220px;
        height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
    }

    .caycanh img {
        max-height: 140px;
        width: auto;
        margin-bottom: 8px;
        object-fit: contain;
    }

    .caycanh b {
        display: block;
        font-size: 14px;
        line-height: 1.2;
        min-height: 5px;
        margin-bottom: 2px;
    }

    .caycanh i {
        color: #e53935;
        font-style: italic;
        font-size: 14px;
    }
</style>