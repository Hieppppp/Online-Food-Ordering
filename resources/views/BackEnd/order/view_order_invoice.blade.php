@extends('BackEnd.admin.home')
@section('title')
    Invoice
@endsection
@section('content')
    <!doctype html>
    <html>
        <head>
            <style>
                body{

                background-color: #000;
                }

                .padding{

                padding: 2rem !important;
                }

                .card {
                margin-bottom: 30px;
                border: none;
                -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
                -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
                box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
                }

                .card-header {
                background-color: #fff;
                border-bottom: 1px solid #e6e6f2;
                }

                h3 {
                font-size: 20px;
                }

                h5 {
                font-size: 15px;
                line-height: 26px;
                color: #3d405c;
                margin: 0px 0px 15px 0px;
                font-family: 'Circular Std Medium';
                }

                .text-dark {
                color: #3d405c !important;
                }

            </style>
        </head>
        <body>
        <div class="offset-xl-1 col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 padding">
            <div class="card">
                <div class="card-header p-4">
                    <a class="pt-2 d-inline-block" href="{{url('/')}}" data-abc="true">Food&Drink Online</a>
                    <div class="float-end"> 
                        <h3 class="mb-0">Hóa Đơn: #{{ now()->format('Ymd') }}{{ Str::random(5) }}</h3>
                        <p class="mb-0">Date: {{$order->created_at->format('Y-m-d')}}</p>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-3">From:</h5>
                            <h3 class="text-dark mb-1">PuppyFat</h3>
                            <div>29 Hàng Trống, quận Hoàn Kiếm, Hà Nội</div>
                            <div>Email: foodonline@gmail.com</div>
                            <div>Phone: +84 9897 989 989</div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-3">To:</h5>
                            <h3 class="text-dark mb-1">{{$customer->name}}</h3>
                            <div>Adress: {{$shipping->address}}</div>
                            <div>Email: {{$shipping->email}}</div>
                            <div>Phone: +84 {{$customer->phone_num}}</div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Item</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @php($subtotal = 0) 
                                @foreach($order_detail as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="fw-bold">{{$item->product_name}}</td>
                                        <td class="text-end">{{$item->product_price}}.000</td>
                                        <td class="text-center">{{$item->product_quantity}}</td>
                                        @php($total = $item->product_price * $item->product_quantity)
                                        @php($subtotal += $total)
                                        <td class="text-end">{{number_format($total, 0, ',', '.')}}.000</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                        </div>
                        <div class="col-lg-4 col-sm-5 ms-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="text-start">
                                            <strong class="text-dark">Subtotal</strong>
                                        </td>
                                        <td class="text-end">
                                            {{number_format($subtotal, 0, ',', '.')}}.000
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">
                                            <strong class="text-dark">Discount (5%)</strong>
                                        </td>
                                        <td class="text-end">{{number_format($subtotal * 0.05, 0, ',', '.')}}.000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">
                                            <strong class="text-dark">VAT (2%)</strong>
                                        </td>
                                        <td class="text-end"> {{number_format(($subtotal - ($subtotal * 0.05)) * 0.02, 0, ',', '.')}}.000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">
                                            <strong class="text-dark">Total</strong>
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-dark">{{number_format($subtotal - ($subtotal * 0.05) + (($subtotal - ($subtotal * 0.05)) * 0.02), 0, ',', '.')}}.000</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <p class="mb-0">Stample Food</p>
                </div>
            </div>
        </div>

        </body>
    </html>


@endsection
