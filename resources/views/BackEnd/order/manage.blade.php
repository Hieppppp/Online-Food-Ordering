@extends('BackEnd.admin.home')
@section('title')
    Order Detail
@endsection
@section('content')
    <!-- @if(Session::get('sms'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{Session::get('sms')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif -->
    <!-- Kết thúc thông báo -->
    <div class="card my-5">
        <div class="card-header">
            <h3 class="card-title">Order</h3>
        </div>
        <div class="card-body" style="height: 500px; overflow-y:scroll;">
            <table id="" class="table table-hover table-striped text-center ">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Customer Name</th>
                        <th>Order Total</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($orders as $order)
                    <tr class='align-middle'>
                        <td>{{$i++}}</td>
                        <td >{{$order->name}}</td>
                        <td>{{number_format($order->order_total, 0, ',', '.')}}.000</td>
                        <td>{{$order->order_status}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            {{$order->payment_type}}
                        </td>
                        <td>
                            {{$order->payment_status}}
                        </td>
                        <td>
                            @if($order->status == 1)
                                <span style="color: green;">Đã duyệt</span>
                            @else
                                <span style="color: red;">Chưa duyệt</span>
                            @endif
                        </td>
                        
                        <td>
                            <a class="btn btn-outline-success" href="{{route('view_order',['order_id'=>$order->order_id])}}">
                                <i class="fas fa-search" title="View Order Detail"></i>
                            </a>

                            <a class="btn btn-outline-info" href="{{route('view_order_invoice',['order_id'=>$order->order_id])}}">
                                <i class="fas fa-search-plus" title="View Invoice"></i> {{--Xem hóa đơn--}}
                            </a>

                            <a class="btn btn-outline-primary" href="{{route('download_order_invoice',['order_id'=>$order->order_id])}}">
                                <i class="fas fa-arrow-circle-down" title="Download Invoice"></i>
                            </a>
                            @if($order->status ==1)
                                <a class="btn btn-outline-success" href="{{route('inactive_order',['order_id'=>$order->order_id])}}">
                                    <i class="fas fa-arrow-up" title="Click to Inactive"></i>
                                </a>
                            @else
                                <a class="btn btn-outline-info" href="{{route('order_active',['order_id'=>$order->order_id])}}">
                                    <i class="fas fa-arrow-down" title="Click to Active"></i>
                                </a>
                            @endif

                            <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="{{--#edit{{$item->product_id}}--}}">
                                <i class="fas fa-edit" title="Click to edit"></i>
                            </a>
                            <a class="btn btn-outline-danger mt-1" id="delete" href="{{route('delete_order',['order_id'=>$order->order_id])}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        
                    </tr>
            
                    
                    <!-- Modal -->
                    {{--<div class="modal fade" id="edit{{$item->product_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('product_update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" name="product_name" value="{{$item->product_name}}">
                                            <input type="hidden" class="form-control" name="product_id" value="{{$item->product_id}}">
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $cate)
                                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Product Detail</label>
                                            <textarea name="product_detail" class="form-control" rows="5">
                                                {{$item->product_detail}}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Image Old</label>
                                            <img style="height: 150px;width: 150px;border-radius: 50%;" src="/product/{{$item->product_image}}" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label class="fw-bold">Image</label>
                                            <input type="file" class="form-control" name="product_image">
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                Dish Attribute
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
                                            <button type="button" class="btn btn-outline-secondary btn-block" data-bs-dismiss="modal">Close</button>
                                            <input onsubmit="validateForm" type="submit" name="btn" class="btn btn-outline-primary btn-block" value="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
                    <!-- End Model -->
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


@endsection