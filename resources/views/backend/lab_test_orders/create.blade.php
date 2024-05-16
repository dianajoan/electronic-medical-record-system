@extends('backend.layouts.master')
@section('title') Add Lab Test Orders @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Add Lab Test Orders</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('lab_test_orders.index') }}">Lab</a></li>
                          <li class="active">Add Lab</li>
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
                <strong>Lab</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{route('lab_test_orders.store')}}" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                  <label for="patient_id">Patient<span class="text-danger">*</span></label>
                  <select name="patient_id" class="form-control" required>
                      <option value="">----</option>
                      @foreach($patients as $key=>$data)
                          <option value='{{$data->id}}'>{{$data->first_name}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="medical_record_id">Medical Records<span class="text-danger">*</span></label>
                  <select name="medical_record_id" class="form-control" required>
                      <option value="">----</option>
                      @foreach($medicals as $key=>$data)
                          <option value='{{$data->id}}'>{{$data->visit_date}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="lab_test_id">Lab Tests<span class="text-danger">*</span></label>
                  <select name="lab_test_id" class="form-control" required>
                      <option value="">----</option>
                      @foreach($labtests as $key=>$data)
                          <option value='{{$data->id}}'>{{$data->name}}</option>
                      @endforeach
                  </select>
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css">

<style>
  #left-panel {
      background-color: #272c33;
  }

  #left-panel .navbar-default {
      background-color: #272c33;
      border-color: #272c33;
  }
</style>

@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#comment').summernote({
            placeholder: "Write detail Message.....",
            tabsize: 2,
            height: 150
        });
    });
</script>
@endpush