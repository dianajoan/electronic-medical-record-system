@extends('backend.layouts.master')
@section('title') Add Lab Test @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Add Lab Test</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin') }}">Dashboard</a></li>
                          <li><a href="{{ route('lab_tests.index') }}">View All Lab Tests</a></li>
                          <li class="active">Add Lab Test</li>
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
              <strong>Add Lab Test</strong>
          </div>
          <div class="card-body card-block">
            <form method="post" action="{{ route('lab_tests.store') }}">
              {{ csrf_field() }}

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
                <label for="name" class="col-form-label">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="duration" class="col-form-label">Duration (in minutes)</label>
                <input id="duration" type="number" name="duration" value="{{ old('duration') }}" class="form-control" required>
                @error('duration')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

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
                <label for="authenticated_by" class="col-form-label">Authenticated By</label>
                <select id="authenticated_by" name="authenticated_by" class="form-control" required>
                  <option value="">Select User</option>
                  @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('authenticated_by') == $user->id ? 'selected' : '' }}>
                      {{ $user->name }}
                    </option>
                  @endforeach
                </select>
                @error('authenticated_by')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{ $message }}</span>
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
