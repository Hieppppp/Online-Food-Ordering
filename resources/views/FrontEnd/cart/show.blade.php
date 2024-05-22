@extends('FrontEnd.master')
@section('title')
    Cart Show Item
@endsection
@section('content')
        <div class="alert-container"></div>
        <!-- @if(Session::get('sms'))
            <div class="alert-container">
                <div id="autoCloseAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('sms')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif  -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                @if(session('cart') && count(session('cart')) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Sản Phẩm</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Gía Cả</th>
                            <th scope="col">Số Lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Chức Năng</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $sum = 0;
                            @endphp
                            @foreach(session('cart') as $id=>$item)
                                @php
                                    // Tính giá trị subtotal của từng sản phẩm
                                    $subtotal = $item['price'] * $item['quantity'];
                                    // Tính tổng giá trị của giỏ hàng
                                    $total += $subtotal;
                                @endphp
                                <tr data-id="{{$id}}">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="/product/{{$item['image']}}" class="img-fluid me-5" style="width: 130px; height: 100px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{$item['product_name']}}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">{{$item['price']}}.000</p>
                                    </td>
                                    <td>
                                        <form action="{{route('update_cart',['id'=>$id])}}" method="post">
                                            @csrf
                                            <div class="input-group quantity mt-4" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input name="quantity" type="text" class="form-control form-control-sm text-center border-0" value="{{$item['quantity']}}" min="1">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    

                                    <td>
                                        <p class="mb-0 mt-4 subtotal">{{ number_format($subtotal, 0, ',', '.') }}.000</p>
                                        <input type="hidden" value="{{$sum = $sum + $subtotal}}">
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-md rounded-circle bg-light border mt-4 cart_remove" data-id="{{$id}}">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Mã giảm giá">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Mã Giảm Gía</button>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Tổng<span class="fw-normal">Đơn Hàng</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Tổng phụ:  {{number_format($sum,0,',','.')}}.000</h5>
                                    <?php
                                        session()->put('sum',$sum);
                                    ?>
                                    <p class="mb-0"></p>
                                </div>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Tổng: {{number_format($sum,0,',','.')}}.000</h5>
                                <p class="mb-0 pe-4"></p>
                            </div>
                            @if(Session::get('customer_id'))
                                <a href="{{url('/shipping')}}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                                    Tiến hành thanh toán
                                </a>
                            @else
                                <a href="" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                                    Tiến hành thanh toán
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-info" role="alert">
                    Không có sản phẩm nào trong giỏ hàng của bạn.
                </div>
                @endif
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="checkoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body model-lg">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="text-center">Xin chào..! To Staple Food</h3>
                                        <div class="text-center mt-3" style="
                                            height: 160px; 
                                            width: 160px; 
                                            margin-left:20px;
                                            border-radius: 50%; 
                                            background-color: darkblue; 
                                            color: white; 
                                            padding-top: 65px; 
                                            font-size: 20px;">
                                            Keep Your Smile ...
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h4>Are you a new member?</h4>
                                        <a href="{{route('sign_up')}}" class="btn btn-primary mt-4 mx-auto d-block" style="width: 200px; font-size: 20px;">Register</a>
                                        <h3 class="mt-2">Or</h3>
                                        <h4 class="mt-2">Already have an account?</h4>
                                        <a href="{{route('login_in')}}" class="btn btn-success mt-4 mx-auto d-block" style="width: 200px; font-size: 20px;">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
