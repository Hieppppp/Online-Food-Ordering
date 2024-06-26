@extends('BackEnd.admin.home')

@section('title')
    Trang Giao Hàng
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-3 col-md-5 my-lg-5">
                @if(Session::get('sms'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('sms')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header text-center" style="font-size: 30px;">
                        Giao Hàng
                    </div>
                    <div class="card-body">
                        <form action="{{route('delivery_save')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="fw-bold">Tên Vận Chuyển </label>
                                <input type="text" class="form-control" name="delivery_name">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Số Điện Thoại </label>
                                <input type="text" class="form-control" name="delivery_phone">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Thẻ Giao Hàng</label>
                                <input type="text" class="form-control" name="delivery_pass">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Ngày Vào</label>
                                <input type="date" class="form-control" name="added_on">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Trạng Thái</label>
                                <div class="radio p-2">
                                    <input type="radio" name="delivery_status" value="1">Đang làm
                                    <input type="radio" name="delivery_status" value="0">Không làm
                                </div>
                                <button type="submit" name="btn" class="btn btn-outline-primary btn-block">
                                    Thêm
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection