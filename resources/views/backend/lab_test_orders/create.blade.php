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
                      <option value="{{ $record->id }}" {{ old('medical_record_id') == $record->id ? 'selected' : '' }}>
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
                      <option value="{{ $user->id }}" {{ old('ordered_by') == $user->id ? 'selected' : '' }}>
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
                      <option value="{{ $genTest->id }}" {{ old('general_test_id') == $genTest->id ? 'selected' : '' }}>
                        {{ $genTest->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('general_test_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="test_name" class="col-form-label">Test Name</label>
                  <textarea class="form-control" id="test_name" name="test_name" required>{{ old('test_name') }}</textarea>
                  @error('test_name')
                  <span class="text-danger">{{ $message }}</span>
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

