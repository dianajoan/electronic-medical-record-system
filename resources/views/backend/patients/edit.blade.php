@extends('backend.layouts.master')
@section('title') Edit Patients @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('patients.index') }}">View</a></li>
                          <li class="active">Edit</li>
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
              <strong>Edit</strong>
          </div>
          <div class="card-body card-block">
            <form method="post" action="{{route('patients.update',$patient->id)}}">
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
                <label for="inputTitle" class="col-form-label">File Number</label>
                <input id="inputTitle" type="text" name="file_number" placeholder=""  value="{{$patient->file_number}}" class="form-control" required>
                @error('file_number')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">First Name</label>
                <input id="inputTitle" type="text" name="first_name" placeholder=""  value="{{$patient->first_name}}" class="form-control" required>
                @error('first_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Last Name</label>
                <input id="inputTitle" type="text" name="last_name" placeholder=""  value="{{$patient->last_name}}" class="form-control" required>
                @error('last_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Gender</label>
                <select name="gender" class="form-control">
                  <option value="male" {{(($patient->gender=='male') ? 'selected' : '')}}>Male</option>
                  <option value="female" {{(($patient->gender=='female') ? 'selected' : '')}}>Female</option>
                </select>
                @error('gender')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

               <div class="form-group">
                <label for="inputTitle" class="col-form-label">Date of Birth</label>
                <input id="inputTitle" type="date" name="date_of_birth" placeholder=""  value="{{$patient->date_of_birth}}" class="form-control" required>
                @error('date_of_birth')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Phone NUmber</label>
                <input id="inputTitle" type="text" name="phone_number" placeholder=""  value="{{$patient->phone_number}}" class="form-control" required>
                @error('phone_number')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Next of Kin Name</label>
                <input id="inputTitle" type="text" name="next_of_kin_name" placeholder=""  value="{{$patient->next_of_kin_name}}" class="form-control" required>
                @error('next_of_kin_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Next of Kin Relationhip</label>
                <input id="inputTitle" type="text" name="next_of_kin_relationship" placeholder=""  value="{{$patient->next_of_kin_relationship}}" class="form-control" required>
                @error('next_of_kin_relationship')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Next of Kin Phone Number</label>
                <input id="inputTitle" type="text" name="next_of_kin_phone_number" placeholder=""  value="{{$patient->next_of_kin_phone_number}}" class="form-control" required>
                @error('next_of_kin_phone_number')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
                <select name="status" class="form-control">
                  <option value="active" {{(($patient->status=='active') ? 'selected' : '')}}>Active</option>
                  <option value="inactive" {{(($patient->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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
