<style>
  .sidebar-nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 240px;
    height: 100vh;
    background-color: #404e68;
    padding-top: 20px;
    z-index: 1000;
    overflow-y: auto;
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
  }
  .sidebar-nav a, .sidebar-nav button {
    color: white !important;
    display: block;
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    text-decoration: none;
  }
  .sidebar-nav a:hover, .sidebar-nav button:hover {
    background-color: rgba(0, 0, 0, 0.2);
  }
  .sidebar-nav a.active {
    background-color: rgba(255, 255, 255, 0.1);
  }
  body {
    margin-left: 240px;
  }
  .logo-sidebar {
    text-align: center;
  }
</style>

<nav class="sidebar-nav">
  <div class="logo-sidebar">
    <a href="{{ url('/') }}">
      <x-application-logo class="w-auto" style="max-height: 40px;" />
    </a>
  </div>


  <ul class="nav flex-column" style="list-style: none; padding: 0; margin: 0;">
    <li>
      <a class="@if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
        {{ __('Bảng điều khiển') }}
      </a>
    </li>
    <li>
      <a class="@if(request()->routeIs('profile.edit')) active @endif" href="{{ route('profile.edit') }}">
        {{ __('Hồ sơ') }}
      </a>
    </li>
    <li>
      <a class="@if(request()->routeIs('')) active @endif" href="">
        {{ __('Quản lý sản phẩm') }}
      </a>
    </li>
    <li>
      <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
        @csrf
        <button type="submit" style="background: none; border: none; width: 100%; text-align: left;">
          {{ __('Đăng xuất') }}
        </button>
      </form>
    </li>
  </ul>
</nav>
