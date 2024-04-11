@extends('backend.layouts.master')
@section('title','Change Password')
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Change Password</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('admin')}}">Dashboard</a></li>
                            <li class="active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong>Change Password</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('change.password') }}">
                            @csrf 
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach 

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection