@extends('FrontEnd.master')
@section('title')
Register
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Sign Up</h2>
                        <form action="{{ route('store_customer') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Username">
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
                                <input type="text" class="form-control" name="phone_num" placeholder="Phone">
                                @error('phone_num')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                @error('password')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" name="conf_pass" placeholder="Confirm Password">
                                @error('conf_pass')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input" name="checkbox" id="terms">
                                <label class="form-check-label" for="terms">I agree to the terms of service</label>
                            </div>
                            <button type="submit" class="btn btn-outline-info btn-block">Sign Up</button>
                        </form>
                        <p class="text-center mt-3">Already have an account? <a href="">Login Now!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
