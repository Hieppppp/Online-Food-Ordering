@extends('BackEnd.admin.home');
@section('title')
    Trang Quản Trị
@endsection
@section('content')
    <div class="container-fluid">
        <style type="text/css">
            p.title_thongke{
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }

        </style>
        <div class="row">
            <p class="title_thongke">Thống Kê Đơn Hàng Doanh Số</p>

            <form action="" autocomplete="off">
                @csrf
                <div class="col-md-7">
                    <p>Từ Ngày:</p>
                </div>
            </form>
        </div>
    </div>
    
@endsection