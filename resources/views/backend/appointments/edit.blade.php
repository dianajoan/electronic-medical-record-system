@extends('backend.layouts.master')
@section('title') Edit Appointment @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit Appointment</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('appointments.index') }}">Appointment</a></li>
                          <li class="active">Edit Appointment</li>
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
                <strong>Edit Appointment</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{route('appointments.update',$appointment->id)}}" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')

                      <div class="form-group">
                        <label for="patient_id">Patient <span class="text-danger">*</span></label>
                        <select name="patient_id" class="form-control" required>
                            <option value="">----</option>
                            @foreach($patients as $key=>$data)
                                <option value='{{$data->id}}' {{(($data->id==$appointment->patient_id)? 'selected' : '')}}>{{$data->first_name}}</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="medical_record_id">Medical Record <span class="text-danger">*</span></label>
                        <select name="medical_record_id" class="form-control" required>
                            <option value="">----</option>
                            @foreach($medicals as $key=>$data)
                                <option value='{{$data->id}}' {{(($data->id==$appointment->medical_record_id)? 'selected' : '')}}>{{$data->visit_date}}</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                          <input id="inputTitle" type="text" name="name" placeholder=""  value="{{$appointment->name}}" class="form-control" required>
                          @error('name')
                          <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>

                    <div class="form-group">
                      <label for="inputTitle" class="col-form-label">Date of Appointment <span class="text-danger">*</span></label>
                      <input id="inputTitle" type="date" name="date" placeholder=""  value="{{$appointment->date}}" class="form-control" required>
                      @error('date')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Time of Appointment <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="time" name="time" placeholder=""  value="{{$appointment->time}}" class="form-control" required>
                    @error('time')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control" required>
                    <option value="postponed" {{(($appointment->status=='postponed') ? 'selected' : '')}}>Postponed</option>
                    <option value="brought_forward" {{(($appointment->status=='brought_forward') ? 'selected' : '')}}>Bought Forward</option>
                    <option value="canceled" {{(($appointment->status=='canceled') ? 'selected' : '')}}>Canceled</option>
                    <option value="started" {{(($appointment->status=='started') ? 'selected' : '')}}>Started</option>
                    <option value="completed" {{(($appointment->status=='completed') ? 'selected' : '')}}>Completed</option>
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