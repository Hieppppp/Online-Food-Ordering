@extends('FrontEnd.master')
@section('title')
    Purchase
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;"><strong>Lịch Sử Mua Hàng</strong></p>
                        </div>
                        <div class="col-xl-3 float-end">
                        <a data-mdb-button-init data-mdb-ripple-init class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                            class="fas fa-print text-primary"></i> Print</a>
                        <a data-mdb-button-init data-mdb-ripple-init class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                            class="far fa-file-pdf text-danger"></i> Export</a>
                        </div>
                        <hr>
                    </div>
                    <div class="container">
                        <div class="col-md-12">
                            <div class="text-center">
                                <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                                <p class="pt-0">PuppyFat Food.com</p>
                            </div>
                        </div>
                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped table-borderless">
                                <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Sản Phẩm</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Gía</th>
                                    <th scope="col">Tổng</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>Pro Package</td>
                                        <td>4</td>
                                        <td>$200</td>
                                        <td>$800</td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 d-flex justify-content-end">
                                <p class="text-black float-start"><span class="text-black me-3">Thành Tiền</span><span
                                    style="font-size: 25px;">$1221</span></p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end align-items-end">
                            <div class="col-xl-12">
                                <button class="btn btn-outline-primary" style="width:150px;">Mua Lại</button>
                                <button class="btn btn-outline-info" style="width:150px;">Liên Hệ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection