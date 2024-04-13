@extends('FrontEnd.master')
@section('title', 'Profile')

@section('content')
    @if(Session::get('sms'))
        <div class="alert-container">
            <div id="autoCloseAlert" class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('sms') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Profile</h4>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{ route('update_profile') }}" method="POST" id="profile_setup_frm" enctype="multipart/form-data">
            @csrf
            <div class="row" id="res">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="profile-photo">
                                @if($customer->image)
                                    <img src="{{ asset('storage/profile_images/' . $customer->image) }}" alt="{{ $customer->name }}" class="mt-5 img-thumbnail rounded-circle" id="customerProfilePicture">
                                @else
                                    <img src="{{ asset('storage/profile_images/avatar.png') }}" alt="Default Avatar" class="mt-5 img-thumbnail rounded-circle" id="customerProfilePicture">
                                @endif
                                <input class="form-control" type="file" name="profile_image" id="profile_image">
                            </div>
                            <h5 class="card-title mt-3">{{ $customer->name }}</h5>
                            <p class="card-text text-muted">{{ $customer->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Personal Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Update Password</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3">
                                <div class="tab-pane fade show active" id="personal-info">
                                    <h5>Personal Information</h5>
                                    
                                    <div class="row" id="res">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="full-name">Full Name</label>
                                                <input type="text" class="form-control" id="full-name" name="name" value="{{ $customer->name }}" placeholder="Enter full name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" placeholder="Enter email" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" class="form-control" id="phone" name="phone_num" value="{{ $customer->phone_num }}" placeholder="Enter phone number">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 text-center">
                                            <button id="btn" type="submit" class="btn btn-outline-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
