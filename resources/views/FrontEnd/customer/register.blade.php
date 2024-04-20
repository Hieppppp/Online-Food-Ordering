@extends('FrontEnd.master')
@section('title')
    Đăng Ký Tài Khoản
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Đăng Ký</h2>
                        <form action="{{ route('store_customer') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Tên tài khoản">
                                @error('name')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                @error('email')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="phone_num" placeholder="Số điện thoại">
                                @error('phone_num')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                                @error('password')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" name="conf_pass" placeholder="Xác nhận lại mật khẩu">
                                @error('conf_pass')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input" name="checkbox" id="terms">
                                <label class="form-check-label" for="terms">Tôi đồng ý với các Điều khoản Dịch vụ!</label>
                            </div>
                            <button type="submit" class="btn btn-outline-info btn-block">Đăng Ký</button>
                        </form>
                        <p class="text-center mt-3">Bạn đã có tài khoản chưa? <a href="">Đăng Nhập Ngay!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
