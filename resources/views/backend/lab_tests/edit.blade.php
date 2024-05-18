@extends('backend.layouts.master')
@section('title') Edit Lab Test @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit Lab Test</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin') }}">Dashboard</a></li>
                          <li><a href="{{ route('lab_tests.index') }}">View All Lab Tests</a></li>
                          <li class="active">Edit Lab Test</li>
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
              <strong>Edit Lab Test</strong>
          </div>
          <div class="card-body card-block">
            <form method="post" action="{{ route('lab_tests.update', $lab_test->id) }}">
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
                <label for="name" class="col-form-label">Name</label>
                <input id="name" type="text" name="name" value="{{ $lab_test->name }}" class="form-control" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="duration" class="col-form-label">Duration (in minutes)</label>
                <input id="duration" type="number" name="duration" value="{{ $lab_test->duration }}" class="form-control" required>
                @error('duration')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="medical_record_id" class="col-form-label">Medical Record</label>
                <select id="medical_record_id" name="medical_record_id" class="form-control" required>
                  <option value="">Select Medical Record</option>
                  @foreach($medicalRecords as $record)
                    <option value="{{ $record->id }}" {{ $lab_test->medical_record_id == $record->id ? 'selected' : '' }}>
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
                    <option value="{{ $user->id }}" {{ $lab_test->authenticated_by == $user->id ? 'selected' : '' }}>
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
                    <option value="active" {{ $lab_test->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $lab_test->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{ $message }}</span>
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
