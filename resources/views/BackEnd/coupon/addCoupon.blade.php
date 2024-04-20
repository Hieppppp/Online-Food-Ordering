@extends('BackEnd.admin.home')

@section('title')
    Trang Phiếu Mua Hàng
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-2 col-md-8 my-lg-8">
                @if(Session::get('sms'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('sms')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header text-center" style="font-size: 30px;">
                        Phiếu Mua Hàng
                    </div>
                    <div class="card-body">
                        <form action="{{route('coupon_save')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Mã Phiếu</label>
                                    <input type="text" class="form-control" name="coupon_code">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Giá Trị Phiếu Giảm Giá</label>
                                    <input type="text" class="form-control" name="coupon_value">
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Giá Trị Tối Thiểu</label>
                                    <input type="text" class="form-control" name="cart_min_value">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Ngày Hết Hạn</label>
                                    <input type="date" class="form-control" name="expired_on">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Ngày Nhập</label>
                                    <input type="date" class="form-control" name="added_on">
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Chọn Loại Phiếu Giảm Giá</label>
                                    <div class="radio p-2">
                                        <input type="radio" name="coupon_type" value="1"> Percentage
                                        <input type="radio" name="coupon_type" value="0"> Fixed
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Trạng Thái</label>
                                    <div class="radio p-2">
                                        <input type="radio" name="coupon_status" value="1"> Hoạt động
                                        <input type="radio" name="coupon_status" value="0"> Không hoạt động
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mx-auto text-center">
                                            <button type="submit" name="btn" class="btn btn-outline-primary btn-block">
                                                Thêm
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection