@extends('backend.layouts.master', ['pageSlug' => 'user'])
@section('title', 'User Create')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">User Create</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('user.index')}}" class="btn btn-sm btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                         <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Email address" value="{{old('email')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password" >
                            </div>
                        </form>   
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                    </nav>
                </div>
            </div>

        </div>
    </div>

@endsection
