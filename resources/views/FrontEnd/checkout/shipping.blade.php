@extends('FrontEnd.master')
@section('title')
    Shipping
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Nhập Thông Tin Vận Chuyển</h2>
                        <form action="{{route('store_shipping')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Họ và Tên</label>
                                <input type="text" class="form-control" name="name" placeholder="Username" value="{{$customer->name}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{$customer->email}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Số Điện Thoại</label>
                                <input type="text" class="form-control" name="phone_num" placeholder="Phone" value="{{$customer->phone_num}}">
                            </div>
                            <div class="form-group mb-3">
                                <label >Địa Chỉ</label>
                                <input type="text" class="form-control" name="address" placeholder="Address">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-outline-info btn-block">Nhập Thông Tin</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection