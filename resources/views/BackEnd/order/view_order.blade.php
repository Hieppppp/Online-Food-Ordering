@extends('BackEnd.admin.home')
@section('title')
    View Order Detail
@endsection
@section('content')
    <!-- Kết thúc thông báo -->
    <div class="offset-2 col-lg-8 col-md-8 col-8">
        <div class="card my-5">
            <div class="card-header">
                <h3 class="card-title text-center">Thông tin khách hàng</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{$customer->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$customer->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{$customer->phone_num}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card my-5">
            <div class="card-header">
                <h3 class="card-title text-center">Chi tiết hóa đơn</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Order ID</th>
                        <td>{{$order->order_id}}</td>
                    </tr>
                    <tr>
                        <th>Order Total</th>
                        <td>{{ number_format($order->order_total, 0, ',', '.') }}.000</td>
                    </tr>
                    <tr>
                        <th>Order Status</th>
                        <td>{{$order->order_status}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card my-5">
            <div class="card-header">
                <h3 class="card-title text-center">Thông tin vận chuyển đơn hàng</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{$shipping->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$shipping->email}}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{$shipping->phone_num}}</td>
                    </tr>
                    <tr>
                        <th>Adress</th>
                        <td>{{$shipping->address}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card my-5">
            <div class="card-header">
                <h3 class="card-title text-center">Thông tin thanh toán</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Payment Type</th>
                        <td>{{$payment->payment_type}}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>{{$payment->payment_status}}</td>
                    </tr>
                    
                </table>
            </div>
        </div>

        <div class="card my-5">
            <div class="card-header">
                <h3 class="card-title text-center">Thông tin chi tiết sản phẩm</h3>
            </div>
            <div class="card-body">
                <table id="" class="table table-hover table-striped text-center ">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Total</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($order_detail as $item)
                        <tr class='align-middle'>
                            <td>{{$i++}}</td>
                            <td>{{$item->product_id}}</td>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->product_price}}</td>
                            <td>{{$item->product_quantity}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                {{number_format($item->product_price * $item->product_quantity, 0, ',', '.')}}.000
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection