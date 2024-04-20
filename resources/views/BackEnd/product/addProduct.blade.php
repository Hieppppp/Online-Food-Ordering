@extends('BackEnd.admin.home')
@section('title')
    Trang Sản Phẩm
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="">
                @if(Session::get('sms'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('sms')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header text-center" style="font-size: 30px;">
                        Sản Phẩm
                    </div>
                    <div class="card-body">
                        <form action="{{route('product_save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Tên</label>
                                    <input type="text" class="form-control" name="product_name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Danh Mục</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Chọn Loại Sản Phẩm</option>
                                        @foreach($categories as $cate)
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Chi Tiết</label>
                                    <textarea name="product_detail" class="form-control" rows="5">
                                    </textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Hình Ảnh</label>
                                    <input type="file" class="form-control" name="product_image">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Ngày Nhập</label>
                                    <input type="date" class="form-control" name="added_on">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Trạng Thái</label>
                                    <div class="radio p-2">
                                        <input type="radio" name="product_status" value="1"> Hoạt động
                                        <input type="radio" name="product_status" value="0"> Không hoạt động
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" title="You can skip this">
                                        Thuộc Tính Sản Phẩm
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="full" placeholder="Full">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="full_price" placeholder="Nhập Giá">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="half" placeholder="Half">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="half_price" placeholder="Nhập giá thứ 2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mx-auto text-center">
                                        <button type="submit" name="btn" class="btn btn-outline-primary btn-block">
                                            Thêm
                                        </button>
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