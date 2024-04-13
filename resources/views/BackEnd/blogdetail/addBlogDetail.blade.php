@extends('BackEnd.admin.home')
@section('title')
    Quản lý chi tiết bài viết
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
                        Blog
                    </div>
                    <div class="card-body">
                        <form action="{{route('blogdetail_save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Tiêu đề</label>
                                    <input type="text" class="form-control" name="blogdetail_name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Thể loại bài viết</label>
                                    <select name="blog_id" id="blog_id" class="form-control">
                                        <option value="">Chọn thể loại</option>
                                        @foreach($blogs as $blog)
                                            <option value="{{$blog->blog_id}}">{{$blog->blog_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Nội Dung</label>
                                    <input type="text" class="form-control" name="blogdetail_content">
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Chi tiết bài viết</label>
                                    <textarea name="blogdetail_detail" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Hình Ảnh</label>
                                    <input type="file" class="form-control" name="blogdetail_image">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Ngày Tạo</label>
                                    <input type="date" class="form-control" name="added_on">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Trạng Thái</label>
                                    <div class="radio p-2">
                                        <input type="radio" name="blogdetail_status" value="1"> Hoạt Động
                                        <input type="radio" name="blogdetail_status" value="0"> Không Hoạt Động
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