@extends('BackEnd.admin.home')
@section('title')
    Blogs
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
                        Blogs
                    </div>
                    <div class="card-body">
                        <form action="{{route('blog_save')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="fw-bold">Tên bài viết</label>
                                <input type="text" class="form-control" name="blog_name">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Số lượng bài</label>
                                <input type="number" class="form-control" name="blog_slug">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Trạng thái bài viết</label>
                                <div class="radio p-2">
                                    <input type="radio" name="blog_status" value="1"> Active
                                    <input type="radio" name="blog_status" value="0"> Inactive
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