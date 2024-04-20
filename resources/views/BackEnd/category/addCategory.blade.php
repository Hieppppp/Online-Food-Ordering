@extends('BackEnd.admin.home')
@section('title')
    Trang Danh Mục
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h4>Loại Sản Phẩm</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb" >
                    <li class="breadcrumb-item">
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Thêm Danh Mục
                    </li>
                </ol>
            </nav>
        </div>
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
                        Danh Mục Sản Phẩm
                    </div>
                    <div class="card-body">
                        <form action="{{route('cate_save')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="fw-bold">Tên Danh Mục </label>
                                <input type="text" class="form-control" name="category_name">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Số Lượng</label>
                                <input type="number" class="form-control" name="order_number">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Ngày Nhập </label>
                                <input type="date" class="form-control" name="added_on">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Trạng Thái</label>
                                <div class="radio p-2">
                                    <input type="radio" name="category_status" value="1"> Hoạt động
                                    <input type="radio" name="category_status" value="0"> Không hoạt động
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