@extends('BackEnd.admin.home')
@section('title')
    Quản Lý Giao Hàng
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
        <div class="card-header">
            <h3 class="card-title">Quản Lý Giao Hàng</h3>
        </div>
        <div class="card-body">
            <table id="" class="table table-hover table-striped text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Giao Hàng</th>
                        <th>Số Điện Thoại</th>
                        <th>Thẻ Giao Hàng</th>
                        <th>Trạng Thái</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($deliveries as $item)
                    <tr class='align-middle'>
                        <td>{{$i++}}</td>
                        <td>{{$item->delivery_name}}</td>
                        <td>{{$item->delivery_phone}}</td>
                        <td>{{$item->delivery_pass}}</td>
                        <td>
                            @if($item->delivery_status == 1)
                                <span style="color: green;">Đang làm</span>
                            @else
                                <span style="color: red;">Không làm</span>
                            @endif
                        </td>
                        <td>
                            @if($item->delivery_status ==1)
                                <a class="btn btn-outline-success" href="{{route('inactive_delivery',['delivery_id'=>$item->delivery_id])}}">
                                    <i class="fas fa-arrow-up" title="Click to Inactive"></i>
                                </a>
                            @else
                                <a class="btn btn-outline-info" href="{{route('delevery_active',['delivery_id'=>$item->delivery_id])}}">
                                    <i class="fas fa-arrow-down" title="Click to Active"></i>
                                </a>
                            @endif
                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit{{$item->delivery_id}}">
                                <i class="fas fa-edit" title="Click to edit"></i>
                            </a>
                            <a class="btn btn-outline-danger" id="delete" href="{{route('delivery_delete',['delivery_id'=>$item->delivery_id])}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Model Edit-->
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$item->delivery_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cập Nhập Giao Hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('delivery_update')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Tên Giao Hàng</label>
                                            <input type="text" class="form-control" name="delivery_name" value="{{$item->delivery_name}}">
                                            <input type="hidden" class="form-control" name="delivery_id" value="{{$item->delivery_id}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Số Điện Thoại</label>
                                            <input type="text" class="form-control" name="delivery_phone" value="{{$item->delivery_phone}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Thẻ Giao Hàng</label>
                                            <input type="text" class="form-control" name="delivery_pass" value="{{$item->delivery_pass}}">
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