@extends('BackEnd.admin.home')
@section('title')
    Category Page
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h4>Category</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb" >
                    <li class="breadcrumb-item">
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add Category
                    </li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="offset-3 col-md-5 my-lg-5">
                @if(Session::get('sms'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('sms')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header text-center" style="font-size: 30px;">
                        Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('cate_save')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="fw-bold">Category Name </label>
                                <input type="text" class="form-control" name="category_name">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Order Number </label>
                                <input type="number" class="form-control" name="order_number">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Add On </label>
                                <input type="date" class="form-control" name="added_on">
                            </div>
                            <div class="form-group">
                                <label class="fw-bold">Category Status</label>
                                <div class="radio p-2">
                                    <input type="radio" name="category_status" value="1"> Active
                                    <input type="radio" name="category_status" value="0"> Inactive
                                </div>
                                <button type="submit" name="btn" class="btn btn-outline-primary btn-block">
                                    Category Add
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection