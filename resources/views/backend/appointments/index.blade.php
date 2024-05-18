@extends('backend.layouts.master')
@section('title') Appointments @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Appointments</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('appointments.create')}}"> Add Appointment</a></li>
                <li class="active">Appointments</li>
              </ol>
          </div>
      </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
      <div class="row">

          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Appointments</strong>
                  </div>
                  <div class="card-body">
                    @if(count($appointments) > 0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Medical Record</th>
                                <th>Patient</th>
                                <th>Clinic</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($appointments as $appointment)
                              <tr>
                                <td>{{ $appointment->id }}</td>
                                <td>{{ $appointment->medicalRecord->visit_date }}</td>
                                <td>{{ $appointment->patient->first_name }}</td>
                                <td>{{ $appointment->clinic->name }}</td>
                                <td>{{ $appointment->name }}</td>
                                <td>{{ $appointment->appointment_date}}</td>
                                <td>
                                    @if($appointment->status == 'postponed')
                                        <span class="badge badge-success">{{ $appointment->status }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $appointment->status }}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" style="display: inline;">
                                    @csrf 
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm dltBtn" data-id="{{ $appointment->id }}" data-toggle="tooltip" title="Delete" data-placement="bottom"><i class="fa fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                    @else
                      <h6 class="text-center">No appointments found! Please add an appointment.</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<style>
  .btn {
    padding: 5px 10px;
  }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#bootstrap-data-table-export').DataTable();
  });
</script>
@endpush
