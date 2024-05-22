@extends('FrontEnd.master')
@section('title')
	Home
@endsection
@section('content')
        <div class="alert-container"></div>
		<!-- Fruits Shop Start-->
		<div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-3">
                        <div class="col-lg-4 text-start">
                            <h1>Danh Mục Loại Sản Phẩm</h1>
                        </div>
                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                @foreach($categories as $category)
                                    <li class="nav-item">
                                        <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-{{$category->category_id}}">
                                            <span class="text-dark" style="width: 130px;">{{$category->category_name}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        @foreach($categories as $category)
                            <div id="tab-{{$category->category_id}}" class="tab-pane fade p-0">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="row g-4">
                                            @foreach($products as $item)
                                                @if($item->category_id == $category->category_id)
                                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                                        <div class="rounded position-relative fruite-item">
                                                            <div class="fruite-img">
                                                                <img src="/product/{{$item->product_image}}" class="img-fluid w-100 rounded-top" alt="">
                                                            </div>
                                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                                <h6>{{$item->product_name}}</h6>
                                                                <p>{!! Str::limit($item->product_detail,50) !!}</p>
                                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                                    <p class="text-dark fs-5 fw-bold mb-0">{{$item->full_price}}.000</p>
                                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-danger add-to-cart" data-product-id="{{$item->product_id}}"><i class="fa fa-shopping-bag me-2 text-danger"></i> Chọn mua</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div id="tab-2" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach($products->take(8) as $item)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="/product/{{$item->product_image}}" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h6 style="height:30px;color:tomato;">{{$item->product_name}}</h6>
                                                    <p>{!! Str::limit($item->product_detail,50) !!}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">{{$item->full_price}}.000</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-danger add-to-cart" data-product-id="{{$item->product_id}}"><i class="fa fa-shopping-bag me-2 text-danger"></i> Chọn mua</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->
        <!-- Vesitable Shop Start-->
        <div class="container-fluid vesitable py-5">
            <div class="container py-5">
            @foreach($productCats as $categoryId => $products)
                <h1 class="mb-0">{{ $categoryNames[$categoryId] }}</h1>
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach($products as $pro)
                        <div class="border border-danger rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="/product/{{ $pro->product_image }}" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="p-4 rounded-bottom">
                                <h6 style="height:30px;color:tomato;">{{ $pro->product_name }}</h6>
                                <p>{!! Str::limit($pro->product_detail, 60) !!}</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold mb-0">{{ $pro->full_price }}.000</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-danger add-to-cart" data-product-id="{{ $pro->product_id }}"><i class="fa fa-shopping-bag me-2 text-danger"></i> Chọn mua</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            </div>
        </div>
        <!-- Vesitable Shop End -->

        <!-- Banner Section Start-->
        <!-- <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
                            <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                            <p class="mb-4 text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.</p>
                            <a href="#" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="{{asset('/frontend')}}/img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                                <h1 style="font-size: 100px;">1</h1>
                                <div class="d-flex flex-column">
                                    <span class="h2 mb-0">50$</span>
                                    <span class="h4 text-muted mb-0">kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Banner Section End -->


        <!-- Bestsaler Product Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                    <h1 class="display-4">Sản Phẩm Bán Chạy Nhất</h1>
                </div>
                <div class="row g-4">
                    @foreach($topProduct as $topsale)
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="/product/{{$topsale->product_image}}" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-6">
                                    <a href="#" class="h6 text-danger">{{ Str::limit($topsale->product_name, 10) }}</a>
                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h6 class="mb-3">₫{{$topsale->full_price}}.000</h6>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-danger add-to-cart" data-product-id="{{$topsale->product_id}}"><i class="fa fa-shopping-bag me-2 text-danger"></i> Chọn mua</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    @foreach($newestProducts as $newPro)
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="text-center">
                            <img src="/product/{{$newPro->product_image}}" class="img-fluid rounded" alt="">
                            <div class="py-2">
                                <a href="" class="text-danger" style="height: 30px;">{{$newPro->product_name}}</a>
                                <div class="d-flex my-3 justify-content-center">
                                    <i class="fas fa-star text-danger"></i>
                                    <i class="fas fa-star text-danger"></i>
                                    <i class="fas fa-star text-danger"></i>
                                </div>
                                <h6 class="mb-3">₫{{$newPro->full_price}}.000</h6>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-danger add-to-cart" data-product-id="{{$newPro->product_id}}"><i class="fa fa-shopping-bag me-2 text-danger"></i> Chọn mua</a>
                            </div>
                        </div>
                    </div>                              
                    @endforeach
                    
                </div>
            </div>
        </div>
        <!-- Bestsaler Product End -->
        <div class="container-fluid featurs py-5">
            <div class="container py-5">
				<h2>Dịch Vụ</h2>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-car-side fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Miễn phí vận chuyển</h5>
                                <p class="mb-0">Free on order over $300</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-user-shield fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Thanh toán bảo mật</h5>
                                <p class="mb-0">100% thanh toán bảo mật</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-exchange-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Hoàn trả trong 30 ngày</h5>
                                <p class="mb-0">Hoàn trả trong 30 ngày</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fa fa-phone-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Hộ trợ 24/7</h5>
                                <p class="mb-0">Hỗ trợ nhanh chóng mọi lúc</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Fact Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light p-5 rounded">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Khách Hàng Hài Lòng</h4>
                                <h1>1963</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Chất Lượng Dịch Vụ</h4>
                                <h1>99%</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Giấy Chứng Nhận Chất Lượng</h4>
                                <h1>33</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Sản Phẩm Có Sẵn</h4>
                                <h1>789</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact Start -->


        <!-- Tastimonial Start -->
        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="testimonial-header text-center">
                    <h4 class="text-danger">Review</h4>
                    <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">Client Name</h4>
                                    <p class="m-0 pb-3">Profession</p>
                                    <div class="d-flex pe-5">
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">Client Name</h4>
                                    <p class="m-0 pb-3">Profession</p>
                                    <div class="d-flex pe-5">
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's standard dummy text ever since the 1500s,
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="img/testimonial-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">Client Name</h4>
                                    <p class="m-0 pb-3">Profession</p>
                                    <div class="d-flex pe-5">
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                        <i class="fas fa-star text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tastimonial End -->
@endsection