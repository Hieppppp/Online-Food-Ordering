@extends('FrontEnd.master')

@section('title')
    CheckOut
@endsection

@section('content')
<div class="products">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-muted text-center">Dear {{ Session::get('customer_name') }}</h3>
                        <h4 class="text-center">Chọn phương pháp thanh toán</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('new_order') }}" method="post">
                            @csrf
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_type" id="cashOnDelivery" value="Cash">
                                <label class="form-check-label" for="cashOnDelivery">
                                    Cash On Delivery
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_type" id="stripe" value="Stripe">
                                <label class="form-check-label" for="stripe">
                                    Stripe
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="btn" class="btn btn-success">Confirm Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
