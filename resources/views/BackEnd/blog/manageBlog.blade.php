@extends('BackEnd.admin.home')
@section('title')
    Quản lý bài viết
@endsection
@section('content')
    @if(Session::get('sms'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('sms')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
   
    <div class="card my-5">
        <div class="card-header">
            <h3 class="card-title">Danh Mục Blog</h3>
        </div>
        <div class="card-body">
            <table id="" class="table table-hover table-striped text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Loại Bài Viết</th>
                        <th>Số Lượng</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($blogs as $item)
                    <tr class='align-middle'>
                        <td>{{$i++}}</td>
                        <td>{{$item->blog_name}}</td>
                        <td>{{$item->blog_slug}}</td>
                        <td>
                            @if($item->blog_status == 1)
                                <span style="color: green;">Active</span>
                            @else
                                <span style="color: red;">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($item->blog_status ==1)
                                <a class="btn btn-outline-success" href="{{route('inactive_blog',['blog_id'=>$item->blog_id])}}">
                                    <i class="fas fa-arrow-up" title="Click to Inactive"></i>
                                </a>
                            @else
                                <a class="btn btn-outline-info" href="{{route('blog_active',['blog_id'=>$item->blog_id])}}">
                                    <i class="fas fa-arrow-down" title="Click to Active"></i>
                                </a>
                            @endif
                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit{{$item->blog_id}}">
                                <i class="fas fa-edit" title="Click to edit"></i>
                            </a>
                            <a class="btn btn-outline-danger" id="delete" href="{{route('blog_delete',['blog_id'=>$item->blog_id])}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Model Edit-->
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$item->blog_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Blog</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('blog_update')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Loại Bài Viết</label>
                                            <input type="text" class="form-control" name="blog_name" value="{{$item->blog_name}}">
                                            <input type="hidden" class="form-control" name="blog_id" value="{{$item->blog_id}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Số Lượng</label>
                                            <input type="number" class="form-control" name="blog_slug" value="{{$item->blog_slug}}">
                                            
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="submit" name="btn" class="btn btn-primary" value="Update">
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