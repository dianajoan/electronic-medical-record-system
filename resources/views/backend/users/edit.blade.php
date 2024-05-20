@extends('backend.layouts.master')
@section('title','Edit User')
@section('main-content')

@include('backend.layouts.notification')

<div class="main-content">
  <div class="section__content section__content--p30">
      <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                  <div class="card-header">
                      <strong>Edit User</strong>
                  </div>
                  <div class="card-body card-block">
                    <form method="post" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
                      @csrf 
                      @method('PATCH')
                      <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Name</label>
                      <input id="inputTitle" type="text" name="name" placeholder=""  value="{{$user->name}}" class="form-control" required>
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                      </div>

                      <div class="form-group">
                          <label for="inputEmail" class="col-form-label">Email</label>
                        <input id="inputEmail" type="email" name="email" placeholder=""  value="{{$user->email}}" class="form-control" required>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                        <div class="form-group">
                          <label for="status" class="col-form-label">Status</label>
                          <select name="status" class="form-control" required>
                              <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>Active</option>
                              <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>Inactive</option>
                          </select>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                      <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>

@endsection
