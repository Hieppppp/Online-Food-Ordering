@extends('BackEnd.admin.home')

@section('title')
    Coupon Page
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-2 col-md-8 my-lg-8">
                @if(Session::get('sms'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('sms')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header text-center" style="font-size: 30px;">
                        Coupon
                    </div>
                    <div class="card-body">
                        <form action="{{route('coupon_save')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Code Name</label>
                                    <input type="text" class="form-control" name="coupon_code">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Coupon Value</label>
                                    <input type="text" class="form-control" name="coupon_value">
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Cart Min value</label>
                                    <input type="text" class="form-control" name="cart_min_value">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Expired Date</label>
                                    <input type="date" class="form-control" name="expired_on">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="fw-bold">Added On</label>
                                    <input type="date" class="form-control" name="added_on">
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Select Coupon Type</label>
                                    <div class="radio p-2">
                                        <input type="radio" name="coupon_type" value="1"> Percentage
                                        <input type="radio" name="coupon_type" value="0"> Fixed
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold">Status</label>
                                    <div class="radio p-2">
                                        <input type="radio" name="coupon_status" value="1"> Active
                                        <input type="radio" name="coupon_status" value="0"> Inactive
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mx-auto text-center">
                                            <button type="submit" name="btn" class="btn btn-outline-primary btn-block">
                                                Coupon Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection