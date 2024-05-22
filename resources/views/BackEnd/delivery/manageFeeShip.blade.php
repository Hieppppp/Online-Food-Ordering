@extends('BackEnd.admin.home')
@section('title')
    Feeship
@endsection
@section('content')
    <div id="alert-container"></div>
    <div class="container">
        <div class="row">
            <div class="">
                @if(Session::get('sms'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('sms')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header text-center" style="font-size: 30px;">
                        Fee Ship
                    </div>
                    <div class="card-body">
                        <form action="">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Chọn Thành Phố</label>
                                        <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        <option value="">--Chọn thành phố--</option>
                                        @foreach($city as $key=> $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Chọn Huyện, Thị Xã</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                        <option value="">--Chọn quận/huyện--</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Chọn Thị Trấn, Xã Phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option value="">--Chọn thị trấn/xã phường--</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Phí vận chuyển</label>
                                <input type="text" name="fee_feeship" class="form-control fee_feeship">
                            </div>
                            <button type="submit" name="add_feeship" class="btn btn-outline-primary add_feeship">
                                Thêm
                            </button>
                        </form>

                    </div>

                    <div id="load_feeship">

                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection