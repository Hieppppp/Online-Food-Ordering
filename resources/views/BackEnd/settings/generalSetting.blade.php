@extends('BackEnd.admin.home')
@section('title')
    Cài Đặt Chung
@endsection
@section('content')
    @if(Session::get('sms'))
        <div class="alert-container">
            <div id="autoCloseAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('sms')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif 
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-12 ms-auto overflow-hidden">
                <h3 class="mb-4">Cài Đặt</h3>
                <!-- Cài Đặt Chung -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        @foreach($settings as $setting)
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Cài Đặt Chung</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s{{$setting->id}}">
                                <i class="fas fa-pencil-alt"></i> Chỉnh Sửa
                            </button>
                        </div>

                        <h5 class="card-title">Tiêu Đề</h5>
                        <h6 class="card-subtitle mb-1 fw-bold">Tiêu Đề Trang Web</h6>
                        <p class="card-text" id="site_title">{{$setting->site_title}}</p>
                        <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                        <p class="card-text" id="site_about">{{$setting->site_about}}</p>

                        <!-- Modal setting -->
                        <div class="modal fade" id="general-s{{$setting->id}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('settings_update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$setting->id}}"> <!-- Hidden input to carry setting ID -->
                                        <div class="modal-header">
                                            <h5 class="modal-title">General Settings</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Tiêu Đề Trang Web</label>
                                                <input type="text" name="site_title" class="form-control shadow-none" value="{{$setting->site_title}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">About us</label>
                                                <textarea name="site_about" class="form-control shadow-none" rows="6" required>{{$setting->site_about}}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Hết Cài Đặt Chung -->

                <!-- Cài Đặt Liên Hệ -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        @foreach($contactsettings as $item)
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Cài Đặt Liên Hệ</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s{{$item->id}}">
                                <i class="fas fa-pencil-alt"></i> Chỉnh Sửa
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Địa Chỉ</h6>
                                    <p class="card-text" id="address">{{$item->address}}</p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap">{{$item->gmap}}</p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Số Điện Thoại</h6>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-phone"></i>
                                        <span id="pn1">{{$item->pn1}}</span>
                                    </p>
                                    <p class="card-text">
                                        <i class="fas fa-phone"></i>
                                        <span id="pn2">{{$item->pn2}}</span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                                    <p class="card-text" id="email">{{$item->email}}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Mạng Xã Hội</h6>
                                    <p class="card-text mb-1">
                                        <i class="fab fa-facebook mb-1"></i>
                                        <span id="fb">{{$item->fb}}</span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="fab fa-instagram mb-1"></i>
                                        <span id="insta">{{$item->insta}}</span>
                                    </p>
                                    <p class="card-text">
                                        <i class="fab fa-twitter"></i>
                                        <span id="tw">{{$item->tw}}</span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                    <iframe class="border w-100 p-2" id="iframe{{$item->id}}" loading="lazy">
                                        {{$item->iframe}}
                                    </iframe>
                                </div>
                            </div>
                        </div>

                        <!-- Modal contact setting -->
                        <div class="modal fade" id="contacts-s{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{route('contactsettings_update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cài Đặt Liên Hệ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <div class="container-fluid p-0">
                                                <div class="row">
                                                    <div class="col-md-6">  
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Địa Chỉ:</label>
                                                            <input type="text" name="address" class="form-control shadow-none" value="{{$item->address}}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Google Map Link:</label>
                                                            <input type="text" name="gmap" class="form-control shadow-none" value="{{$item->gmap}}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Số Điện Thoại (mã vùng quốc gia):</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                <input type="number" name="pn1" class="form-control shadow-none" value="{{$item->pn1}}">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                                <input type="number" name="pn2" class="form-control shadow-none" value="{{$item->pn2}}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Email</label>
                                                            <input type="email" name="email" class="form-control shadow-none" value="{{$item->email}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Mạng Xã Hội</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                                                <input type="text" name="fb" class="form-control shadow-none" value="{{$item->fb}}" required>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                                                <input type="text" name="insta" class="form-control shadow-none" value="{{$item->insta}}" required>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                                                <input type="text" name="tw" class="form-control shadow-none" value="{{$item->tw}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">iFrame Src</label>
                                                            <input type="text" name="iframe" class="form-control shadow-none" value="{{$item->iframe}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Hêt Cài Đặt Liên Hệ -->

            </div>

        </div>

    </div>
@endsection