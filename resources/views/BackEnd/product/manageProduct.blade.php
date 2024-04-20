@extends('BackEnd.admin.home')
@section('title')
    Quản Lý Sản Phẩm
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
            <h3 class="card-title">Quản Lý Sản Phẩm</h3>
        </div>
        <form action="" method="get" class="mb-3 p-3">
            <div class="row">
                <div class="col-3">
                    <select name="product_status" id="product_status" class="form-control">
                        <option value="0">Tất cả trạng thái</option>
                        <option value="active" {{request()->product_status=='active'?'selected':false}}>Kích hoạt</option>
                        <option value="inactive" {{request()->product_status=='inactive'?'selected':false}}>Chưa kích hoạt</option>
                    </select>
                </div>

                <div class="col-3">
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="0">Tất cả nhóm</option>
                        @foreach($categories as $cate)
                            <option value="{{$cate->category_id}}" {{request()->category_id=='$cate->id'?'selected':false}}>{{$cate->category_name}}</option>
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
                        <th><a href="?sort-by=product_name&sort-type={{ $sortType }}">Tên</a></th>
                        <th>Danh Mục</th>
                        <th>Hình Ảnh</th>
                        <th>Chi Tiết</th>
                        <!-- <th>Time</th> -->
                        <th>Trạng Thái</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($producties as $item)
                    <tr class='align-middle'>
                        <td>{{$i++}}</td>
                        <td width="15%">{{$item->product_name}}</td>
                        <td>{{$item->category_name}}</td>
                        <td>
                            <img width="150px" height="150px" class="img-fluid img-thumbnail" src="/product/{{$item->product_image}}" alt="">
                        </td>
                        <td>{!! Str::limit($item->product_detail,10)!!}</td>
                        <!-- <td>{{$item->added_on}}</td> -->
                        <td>
                            @if($item->product_status == 1)
                                <span style="color: green;">Hoạt động</span>
                            @else
                                <span style="color: red;">Không hoạt động</span>
                            @endif
                        </td>
                        <td>
                            @if($item->product_status ==1)
                                <a class="btn btn-outline-success" href="{{route('inactive_product',['product_id'=>$item->product_id])}}">
                                    <i class="fas fa-arrow-up" title="Click to Inactive"></i>
                                </a>
                            @else
                                <a class="btn btn-outline-info" href="{{route('product_active',['product_id'=>$item->product_id])}}">
                                    <i class="fas fa-arrow-down" title="Click to Active"></i>
                                </a>
                            @endif
                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit{{$item->product_id}}">
                                <i class="fas fa-edit" title="Click to edit"></i>
                            </a>
                            <a class="btn btn-outline-danger" id="delete" href="{{route('product_delete',['product_id'=>$item->product_id])}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        
                    </tr>
                    <!-- Model Edit-->
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$item->product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cập Nhập Sản Phẩm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('product_update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên Sản Phẩm</label>
                                            <input type="text" class="form-control" name="product_name" value="{{$item->product_name}}">
                                            <input type="hidden" class="form-control" name="product_id" value="{{$item->product_id}}">
                                        </div>
                                        <div class="form-group">
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
                                                {{$item->product_detail}}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Hình Ảnh Cũ</label>
                                            <img style="height: 150px;width: 150px;border-radius: 50%;" src="/product/{{$item->product_image}}" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Hình Ảnh Mới</label>
                                            <input type="file" class="form-control" name="product_image">
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                Thuộc Tính Sản Phẩm
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <input type="text" class="form-control" name="full" placeholder="Full" value="{{$item->full}}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <input type="text" class="form-control" name="full_price" placeholder="Enter Price" value="{{$item->full_price}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <input type="text" class="form-control" name="half" placeholder="Half" value="{{$item->half}}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <input type="text" class="form-control" name="half_price" placeholder="enter 2nd price" value="{{$item->half_price}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                    
                                        <div class="form-group">
                                            <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">Đóng</button>
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