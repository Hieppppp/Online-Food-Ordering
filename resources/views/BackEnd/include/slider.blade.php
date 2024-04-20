@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ asset('admin/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h5">PuppyFat</h1>
            <p>Web Site</p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus-->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li>
            <a href="#blogDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-folder-open"></i>Danh Mục Bài Viết</a>
            <ul id="blogDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_blog_table') }}">Thêm Loại Blog</a></li>
                <li><a href="{{ route('manage_blog') }}">Danh Sách Loại Blog</a></li>
            </ul>
        </li>
        <li>
            <a href="#blogdetailDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-folder"></i>Quản Lý Bài Viết</a>
            <ul id="blogdetailDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_blogdetail_table') }}">Thêm Bài Viết</a></li>
                <li><a href="{{ route('manage_blogdetail') }}">Danh Sách Bài Viết</a></li>
            </ul>
        </li>
        <li class="parent {{ $prefix == '/category' ? 'menu-open' : '' }}">
            <a href="#categoryDropdown" aria-expanded="false" data-toggle="collapse"><i class="icon-windows"></i>Quản Lý Loại Sản Phẩm</a>
            <ul id="categoryDropdown" class="collapse list-unstyled">
                <li>
                    <a href="{{ route('show_cate_table') }}" class="{{ $route == 'show_cate_table' ? 'active' : '' }}">Thêm Loại Sản Phẩm</a>
                </li>
                <li>
                    <a href="{{ route('manage_cate') }}" class="{{ $route == 'manage_cate' ? 'active' : '' }}">Danh Sách Loại Sản Phẩm</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#productDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-store"></i>Quản Lý Sản Phẩm</a>
            <ul id="productDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_product_table') }}">Thêm Sản Phẩm</a></li>
                <li><a href="{{ route('manage_product') }}">Danh Sách Sản Phẩm</a></li>
            </ul>
        </li>
        <li>
            <a href="#deliveryDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-truck"></i>Quản Lý Vận Chuyển</a>
            <ul id="deliveryDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_delivery_table') }}">Thêm Vận Chuyển</a></li>
                <li><a href="{{ route('manage_feeship') }}">Danh Sách Feeship</a></li>
                <li><a href="{{ route('manage_delivery') }}">Danh Sách Vận Chuyển</a></li>
            </ul>
        </li>
        <li>
            <a href="#couponDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-wallet"></i>Phiếu Mua Hàng</a>
            <ul id="couponDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_coupon_table') }}">Thêm Mã Phiếu</a></li>
                <li><a href="{{ route('manage_coupon') }}">Danh Sách Mã Phiếu</a></li>
            </ul>
        </li>
        <li>
            <a href="#orderDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-shopping-cart"></i>Lịch sử mua hàng</a>
            <ul id="orderDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('manage_order') }}">Quản Lý Đơn Hàng</a></li>
            </ul>
        </li>
        <li>
            <a href="#settingDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-cog"></i>Cài Đặt</a>
            <ul id="settingDropdown" class="collapse list-unstyled">
                <li><a href="{{route('setting_general')}}">Cài Đặt Chung</a></li>
                <li><a href="">Cài Đặt Liên Hệ</a></li>
                <li><a href="">Demo</a></li>
            </ul>
            
        </li>
        <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
    </ul>
</nav>

