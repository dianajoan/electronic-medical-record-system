@extends('backend.layouts.master')
@section('title') Add Drug @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Add Drug</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('drugs.index') }}">Drugs</a></li>
                          <li class="active">Add Drug</li>
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
                <strong>Drug</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{route('drugs.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}

                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif


                      <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="name" placeholder=""  value="{{old('name')}}" class="form-control" required>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="inputTitle" class="col-form-label">Brand Name <span class="text-danger">*</span></label>
                      <input id="inputTitle" type="text" name="brand_name" placeholder=""  value="{{old('brand_name')}}" class="form-control" required>
                      @error('brand_name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Form of the drug (e.g., syrup, tablet, ointment, injection)<span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="form" placeholder=""  value="{{old('form')}}" class="form-control" required>
                    @error('form')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                  <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Code <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="code" placeholder=""  value="{{old('code')}}" class="form-control" required>
                    @error('code')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                  <label for="status" class="col-form-label">Status<span class="text-danger">*</span></label>
                  <select name="status" class="form-control" required>
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
                  </select>
                  @error('status')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button class="btn btn-success" type="submit">Submit</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

