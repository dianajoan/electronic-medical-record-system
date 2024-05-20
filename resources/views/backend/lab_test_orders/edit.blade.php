@extends('backend.layouts.master')
@section('title') Edit Lab Test Orders @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit Lab Test Orders</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('lab_test_orders.index') }}">Lab</a></li>
                          <li class="active">Edit Lab</li>
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
                <strong>Edit Lab Test Orders</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{route('lab_test_orders.update',$lab_test_order->id)}}" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')

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
                  <label for="medical_record_id" class="col-form-label">Medical Record</label>
                  <select id="medical_record_id" name="medical_record_id" class="form-control" required>
                    <option value="">Select Medical Record</option>
                    @foreach($medicalRecords as $record)
                      <option value="{{ $record->id }}" {{ $lab_test_order->medical_record_id == $record->id ? 'selected' : '' }}>
                        {{ $record->symptoms }}
                      </option>
                    @endforeach
                  </select>
                  @error('medical_record_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
  
                <div class="form-group">
                  <label for="ordered_by" class="col-form-label">Ordered By</label>
                  <select id="ordered_by" name="ordered_by" class="form-control" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                      <option value="{{ $user->id }}" {{ $lab_test_order->ordered_by == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('ordered_by')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="general_test_id" class="col-form-label">General Test</label>
                  <select id="general_test_id" name="general_test_id" class="form-control" required>
                    <option value="">Select Medical Record</option>
                    @foreach($genTests as $genTest)
                      <option value="{{ $genTest->id }}" {{ $lab_test_order->general_test_id == $genTest->id ? 'selected' : '' }}>
                        {{ $genTest->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('general_test_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Test Name <span class="text-danger">*</span></label>
                  <input id="inputTitle" type="text" name="test_name" placeholder=""  value="{{$lab_test_order->test_name}}" class="form-control" required>
                  @error('test_name')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>

                <div class="form-group">
                  <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control" required>
                    <option value="active" {{(($lab_test_order->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($lab_test_order->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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

@endsection
