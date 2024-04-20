@extends('BackEnd.admin.home')
@section('title')
    Quản Lý Phiếu Giảm Giá
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
            <h3 class="card-title">Quản Lý Phiếu Giảm Giá</h3>
        </div>
        <div class="card-body">
            <table id="" class="table table-hover table-striped text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã</th>
                        <th>Kiểu</th>
                        <th>Giá Trị</th>
                        <th>Giá Trị Tối Thiểu</th>
                        <th>Ngày Hết Hạn</th>
                        <th>Ngày Nhập</th>
                        <th>Trạng Thái</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($coupons as $item)
                    <tr class='align-middle'>
                        <td>{{$i++}}</td>
                        <td>{{$item->coupon_code}}</td>
                        <td>
                            @if($item->coupon_type == 1)
                                <span>Percentage</span>
                            @else
                                <span>Fixed</span>
                            @endif
                        </td>
                        <td>{{$item->coupon_value}}</td>
                        <td>{{$item->cart_min_value}}</td>
                        <td>{{$item->expired_on}}</td>
                        <td>{{$item->added_on}}</td>
                        <td>
                            @if($item->coupon_status == 1)
                                <span style="color: green;">Hoạt động</span>
                            @else
                                <span style="color: red;">Không hoạt động</span>
                            @endif
                        </td>
                        <td>
                            @if($item->coupon_status ==1)
                                <a class="btn btn-outline-success" href="{{route('inactive_coupon',['coupon_id'=>$item->coupon_id])}}">
                                    <i class="fas fa-arrow-up" title="Click to Inactive"></i>
                                </a>
                            @else
                                <a class="btn btn-outline-info" href="{{route('coupon_active',['coupon_id'=>$item->coupon_id])}}">
                                    <i class="fas fa-arrow-down" title="Click to Active"></i>
                                </a>
                            @endif
                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit{{$item->coupon_id}}">
                                <i class="fas fa-edit" title="Click to edit"></i>
                            </a>
                            <a class="btn btn-outline-danger" id="delete" href="{{route('coupon_delete',['coupon_id'=>$item->coupon_id])}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Model Edit-->
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$item->coupon_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cập Nhập Phiếu Giảm Giá </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('coupon_update')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="fw-bold">Mã</label>
                                                <input type="text" class="form-control" name="coupon_code" value="{{$item->coupon_code}}">
                                                <input type="hidden" class="form-control" name="coupon_id" value="{{$item->coupon_id}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="fw-bold">Giá Trị</label>
                                                <input type="text" class="form-control" name="coupon_value" value="{{$item->coupon_value}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="fw-bold">Giá Trị Tối Thiểu</label>
                                                <input type="text" class="form-control" name="cart_min_value" value="{{$item->cart_min_value}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="fw-bold">Chọn Loại Phiếu Giảm Giá</label>
                                                <div class="radio p-2">
                                                    <input type="radio" name="coupon_type" value="1"> Percentage
                                                    <input type="radio" name="coupon_type" value="0"> Fixed
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                <input type="submit" name="btn" class="btn btn-primary" value="Update">
                                            </div>
                                            
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