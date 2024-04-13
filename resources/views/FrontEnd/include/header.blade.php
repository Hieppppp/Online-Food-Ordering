<!-- Spinner Start -->
	<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->
        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                        <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="{{route('home')}}" class="navbar-brand"><h1 class="text-primary display-6">Food Online</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
                            <a href="{{route('show_product')}}" class="nav-item nav-link">Shop</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="{{route('cart_show')}}" class="dropdown-item">Cart</a>
                                    <a href="testimonial.html" class="dropdown-item">Delivery</a>
                                </div>
                            </div>
                            <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal">
                                <i class="fas fa-search text-primary"></i>
                            </button>
                            <a href="" type="button" class="position-relative me-4 my-auto btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cartModal">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -1px; left: 25px; height: 20px; min-width: 20px;">{{ count((array) session('cart')) }}</span>
                            </a>

                            <ul class="navbar-nav ml-auto">
                                @if(Session::get('customer_id'))
                                    @php
                                        $customer = App\Models\Customer::find(Session::get('customer_id'));
                                    @endphp
                                    @if($customer)
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="user-icon">
                                                    @if($customer->image)
                                                        <img src="{{ asset('storage/profile_images/' . $customer->image) }}" alt="images" style="width: 40px; height: 40px; border-radius: 50%;">
                                                    @else
                                                        <img src="{{ asset('storage/profile_images/avatar.png') }}" alt="Default Avatar" style="width: 40px; height: 40px; border-radius: 50%;">
                                                    @endif
                                                </span>
                                                {{ Session::get('customer_name') }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{route('customer_profile')}}">Tài Khoản Của Tôi</a>
                                                <a class="dropdown-item" href="{{ route('customer_purchase') }}">Đơn Mua</a>

                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('log_out') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Đăng Xuất</button>
                                                </form>
                                            </div>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('login_in') }}" class="nav-link">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sign_up') }}" class="nav-link">Resgister</a>
                                    </li>
                                @endif
                            </ul>


                        </div>

                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" >Giỏ Hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body overflow-y:scroll;">
                        <div class="row">
                            @php
                                $total=0
                            @endphp
                            @foreach((array) session('cart') as $id =>$item)
                                @php
                                    $total+=$item['price']*$item['quantity']
                                @endphp
                            @endforeach
                            <div class="col-lg-12 col-sm-12 col-12 text-left">
                                <p>Tổng: <span class="text-info">{{number_format($total,0,',','.')}}.000</span></p>
                            </div>
                        </div>
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $item)
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4 col-4">
                                        <img src="/product/{{$item['image']}}" class="img-fluid me-5 mb-3" style="width: 120px; height: 90px;" alt="">
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8">
                                        <p >{{$item['product_name']}}</p>
                                        <span class="text-dark">Giá: {{$item['price']}}</span>
                                        <span class="count">Quantity: {{$item['quantity']}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('cart_show')}}" class="btn btn-primary">Xem giỏ hàng</a>
                    </div>
                </div>
            </div>
         </div>
        
