@extends('BackEnd.admin.home')
@section('title')
    Quản lý chi tiết bài viết
@endsection
@section('content')
    @if(Session::get('sms'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('sms')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Kết thúc thông báo -->
    <div class="card my-5">
        <div class="card-header mb-4">
            <h3 class="card-title">Quản Lý Bài Viết</h3>
        </div>
        <form action="" method="get" class="mb-3 p-3">
            <div class="row">
                <div class="col-3">
                    <select name="blogdetail_status" id="blogdetail_status" class="form-control">
                        <option value="0">Tất cả trạng thái</option>
                        <option value="active" {{request()->blogdetail_status=='active'?'selected':false}}>Kích hoạt</option>
                        <option value="inactive" {{request()->blogdetail_status=='inactive'?'selected':false}}>Chưa kích hoạt</option>
                    </select>
                </div>

                <div class="col-3">
                    <select name="blog_id" id="blog_id" class="form-control">
                        <option value="0">Tất cả nhóm</option>
                        @foreach($blogs as $blog)
                            <option value="{{$blog->blog_id}}" {{request()->blog_id=='$blog->id'?'selected':false}}>{{$blog->blog_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <input type="search" name="keywords" class="form-control" 
                    placeholder="Từ khóa tìm kiếm..." value="{{request()->keywords}}">
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <div class="card-body" style="height: 500px; overflow-y:scroll;">
            <table id="" class="table table-hover table-striped text-center ">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Thể Loại</th>
                        <th><a href="?sort-by=product_name&sort-type={{ $sortType }}">Tên Bài Viết</a></th>
                        <th>Hình Ảnh</th>
                        <th>Nội Dung</th>
                        <th>Chi Tiết</th>
                        <!-- <th>Time</th> -->
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($blogdetails as $item)
                    <tr class='align-middle'>
                        <td>{{$i++}}</td>
                        <td>{{$item->blog_name}}</td>
                        <td width="15%">{{$item->blogdetail_name}}</td>
                        <td>
                            <img width="150px" height="150px" class="img-fluid img-thumbnail" src="/blog/{{$item->blogdetail_image}}" alt="">
                        </td>
                        <td>{{$item->blogdetail_content}}</td>
                        <td>{!! Str::limit($item->blogdetail_detail,50)!!}</td>
                        <!-- <td>{{$item->added_on}}</td> -->
                        <td>
                            @if($item->blogdetail_status == 1)
                                <span style="color: green;">Active</span>
                            @else
                                <span style="color: red;">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($item->blogdetail_status ==1)
                                <a class="btn btn-outline-success" href="{{route('inactive_blogdetail',['blogdetail_id'=>$item->blogdetail_id])}}">
                                    <i class="fas fa-arrow-up" title="Click to Inactive"></i>
                                </a>
                            @else
                                <a class="btn btn-outline-info" href="{{route('blogdetail_active',['blogdetail_id'=>$item->blogdetail_id])}}">
                                    <i class="fas fa-arrow-down" title="Click to Active"></i>
                                </a>
                            @endif
                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit{{$item->blogdetail_id}}">
                                <i class="fas fa-edit" title="Click to edit"></i>
                            </a>
                            <a class="btn btn-outline-danger" id="delete" href="{{route('blogdetail_delete',['blogdetail_id'=>$item->blogdetail_id])}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        
                    </tr>
                    <!-- Model Edit-->
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$item->blogdetail_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Blogdetail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('blogdetail_update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên Bài Viết</label>
                                            <input type="text" class="form-control" name="blogdetail_name" value="{{$item->blogdetail_name}}">
                                            <input type="hidden" class="form-control" name="blogdetail_id" value="{{$item->blogdetail_id}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Thể Loại</label>
                                            <select name="blog_id" id="blog_id" class="form-control">
                                                <option value="">Chọn Thể Loại</option>
                                                @foreach($blogs as $blog)
                                                    <option value="{{$blog->blog_id}}">{{$blog->blog_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tên Bài Viết</label>
                                            <input type="text" class="form-control" name="blogdetail_content" value="{{$item->blogdetail_content}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Chi tiết bài viết</label>
                                            <textarea name="blogdetail_detail" class="form-control" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Hình Ảnh Cũ</label>
                                            <img style="height: 150px;width: 150px;border-radius: 50%;" src="/blog/{{$item->blogdetail_image}}" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Hình Ảnh</label>
                                            <input type="file" class="form-control" name="blogdetail_image">
                                        </div>    
                                        <div class="form-group">
                                            <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">Close</button>
                                            <input onsubmit="validateForm" type="submit" name="btn" class="btn btn-outline-primary btn-block" value="Update">
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="modal-footer">
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- End Model -->
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>



    


@endsection