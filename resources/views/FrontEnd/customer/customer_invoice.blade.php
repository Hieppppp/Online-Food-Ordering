@extends('FrontEnd.master')
@section('title')
    Purchase
@endsection
@section('content')
<div class="container">
    <h1>Lịch sử đơn hàng</h1>
    @if($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
        <table class="table text-center">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->order_status}}</td>
                        <td>{{number_format($order->order_total, 0, ',', '.') }}.000 VND</td>
                        <td><a href="{{route ('customer_viewpurchase',['order_id'=>$order->order_id])}}">Xem chi tiết</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection