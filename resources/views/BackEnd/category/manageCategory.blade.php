@extends('BackEnd.admin.home')
@section('title')
    Quản Lý Danh Mục Loại Sản Phẩm
@endsection
@section('content')
    <!-- Thông báo -->
    @if(Session::get('sms'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('sms')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Kết thúc thông báo -->
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
                        Quản Lý Danh Sách Loại Sản Phẩm
                    </li>

                </ol>
            </nav>
        </div>

    </div>
    


    <div class="card my-5">
        <div class="card-header">
            <h3 class="card-title">Quản Lý Danh Sách Loại Sản Phẩm</h3>
        </div>
        <div class="card-body">
            <table id="" class="table table-hover table-striped text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Danh Mục</th>
                        <th>Số Lượng</th>
                        <th>Trạng Thái</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($categories as $item)
                    <tr class='align-middle'>
                        <td>{{$i++}}</td>
                        <td>{{$item->category_name}}</td>
                        <td>{{$item->order_number}}</td>
                        <td>
                            @if($item->category_status == 1)
                                <span style="color: green;">Hoạt động</span>
                            @else
                                <span style="color: red;">Không hoạt động</span>
                            @endif
                        </td>
                        <td>
                            @if($item->category_status ==1)
                                <a class="btn btn-outline-success" href="{{route('inactive_cate',['category_id'=>$item->category_id])}}">
                                    <i class="fas fa-arrow-up" title="Click to Inactive"></i>
                                </a>
                            @else
                                <a class="btn btn-outline-info" href="{{route('category_active',['category_id'=>$item->category_id])}}">
                                    <i class="fas fa-arrow-down" title="Click to Active"></i>
                                </a>
                            @endif
                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit{{$item->category_id}}">
                                <i class="fas fa-edit" title="Click to edit"></i>
                            </a>
                            <a class="btn btn-outline-danger" id="delete" href="{{route('cate_delete',['category_id'=>$item->category_id])}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Model Edit-->
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$item->category_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cập Nhập Danh Mục Loại Sản Phẩm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('cate_update')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên Danh Mục</label>
                                            <input type="text" class="form-control" name="category_name" value="{{$item->category_name}}">
                                            <input type="hidden" class="form-control" name="category_id" value="{{$item->category_id}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Số Lượng</label>
                                            <input type="number" class="form-control" name="order_number" value="{{$item->order_number}}">
                                            
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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

