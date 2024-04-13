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
                <li><a href="{{ route('show_blog_table') }}">Add Blog</a></li>
                <li><a href="{{ route('manage_blog') }}">Manage Blog</a></li>
            </ul>
        </li>
        <li>
            <a href="#blogdetailDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-folder"></i>Quản Lý Bài Viết</a>
            <ul id="blogdetailDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_blogdetail_table') }}">Add BlogDetail</a></li>
                <li><a href="{{ route('manage_blogdetail') }}">Manage BlogDetail</a></li>
            </ul>
        </li>
        <li class="parent {{ $prefix == '/category' ? 'menu-open' : '' }}">
            <a href="#categoryDropdown" aria-expanded="false" data-toggle="collapse"><i class="icon-windows"></i>Quản Lý Loại Sản Phẩm</a>
            <ul id="categoryDropdown" class="collapse list-unstyled">
                <li>
                    <a href="{{ route('show_cate_table') }}" class="{{ $route == 'show_cate_table' ? 'active' : '' }}">Add Category</a>
                </li>
                <li>
                    <a href="{{ route('manage_cate') }}" class="{{ $route == 'manage_cate' ? 'active' : '' }}">Manage Category</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#productDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-store"></i>Quản Lý Sản Phẩm</a>
            <ul id="productDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_product_table') }}">Add Product</a></li>
                <li><a href="{{ route('manage_product') }}">Manage Product</a></li>
            </ul>
        </li>
        <li>
            <a href="#deliveryDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-truck"></i>Quản Lý Vận Chuyển</a>
            <ul id="deliveryDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_delivery_table') }}">Add Delivery</a></li>
                <li><a href="{{ route('manage_delivery') }}">Manage Delivery</a></li>
            </ul>
        </li>
        <li>
            <a href="#couponDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-wallet"></i>Phiếu Mua Hàng</a>
            <ul id="couponDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('show_coupon_table') }}">Add Coupon</a></li>
                <li><a href="{{ route('manage_coupon') }}">Manage Coupon</a></li>
            </ul>
        </li>
        
        <li>
            <a href="#orderDropdown" aria-expanded="false" data-toggle="collapse"><i class="fas fa-shopping-cart"></i>Lịch sử mua hàng</a>
            <ul id="orderDropdown" class="collapse list-unstyled">
                <li><a href="{{ route('manage_order') }}">Manage Order</a></li>
            </ul>
        </li>
        <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
    </ul>
</nav>

