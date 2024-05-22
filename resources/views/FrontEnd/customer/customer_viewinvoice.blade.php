<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .head{
            margin-top: 30px;
            margin-left: 150px;
            font-size: 20px;
            display: flex;
            gap: 10px;
        }
        .head a{
            text-decoration: none;
            color: inherit;
        }
        .head a:hover{
            color: tomato;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #343a40;
        }

        h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #495057;
        }

        p {
            margin: 5px 0;
            color: #495057;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #343a40;
            color: #fff;
        }

        table td img {
            display: block;
            margin: 0 auto;
        }

        h4 {
            margin-top: 20px;
            text-align: right;
            color: #343a40;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            table th, table td {
                padding: 5px;
            }
        }

    </style>
</head>
<body>
    <div class="head">
        <div><a href="{{route('customer_purchase')}}">Trang Chủ</a></div>
        <div>-></div>
        <div>Chi Tiết Đơn Hàng</div>
    </div>
    <div class="container">
        <h1>Chi tiết đơn hàng #{{ $orders->order_id }}</h1>
        <div>
            <h3>Thông tin khách hàng</h3>
            <p>Tên: {{ $customer->name }}</p>
            <p>Email: {{ $customer->email }}</p>
            <p>Điện thoại: {{ $customer->phone_num }}</p>
        </div>
        <div>
            <h3>Thông tin giao hàng</h3>
            <p>Tên: {{ $shipping->name }}</p>
            <p>Địa chỉ: {{ $shipping->address }}</p>
            <p>Số điện thoại: {{ $shipping->phone_num }}</p>
        </div>
        <div>
            <h3>Thông tin thanh toán</h3>
            <p>Hình thức thanh toán: {{ $payment->payment_type }}</p>
            <p>Trạng thái thanh toán: {{ $payment->payment_status ? 'Đã thanh toán' : 'Chưa thanh toán' }}</p>
        </div>
        <div>
            <h3>Sản phẩm trong đơn hàng</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_detail as $detail)
                        <tr>
                            <td><img src="{{ asset('product/' . $detail->product->product_image) }}" width="50" height="50" alt="{{ $detail->product->product_name }}"></td>
                            <td>{{ $detail->product->product_name }}</td>
                            <td>{{ number_format($detail->product_price, 0, ',', '.') }}.000 VND</td>
                            <td>{{ $detail->product_quantity }}</td>
                            <td>{{ number_format($detail->product_price * $detail->product_quantity, 0, ',', '.') }}.000 VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <h4>Tổng tiền: {{ number_format($orders->order_total, 0, ',', '.') }}.000 VND</h4>
            </div>
        </div>
    </div>
</body>
</html>