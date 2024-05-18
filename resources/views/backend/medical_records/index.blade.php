@extends('backend.layouts.master')
@section('title') Medical Records @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Medical Records</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                  <li><a href="{{ route('admin') }}">Dashboard</a></li>
                  <li><a href="{{ route('medical_records.create') }}">Add Medical Records</a></li>
                  <li class="active">Medical Records</li>
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
                      <strong class="card-title">Medical Records</strong>
                  </div>
                  <div class="card-body">
                      @if(count($medicalRecords) > 0)
                          <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Patient</th>
                                      <th>Visit Date</th>
                                      <th>Primary Diagnosis</th>
                                      <th>Secondary Diagnoses</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($medicalRecords as $medical)
                                      <tr>
                                          <td>{{ $medical->id }}</td>
                                          <td>{{ $medical->patient->first_name }} {{ $medical->patient->last_name }}</td>
                                          <td>{{ $medical->visit_date}}</td>
                                          <td>{{ $medical->primaryDiagnosis->name }}</td>
                                          <td>
                                              @foreach($medical->secondaryDiagnoses as $secondaryDiagnosis)
                                                  {{ $secondaryDiagnosis->name }}@if(!$loop->last), @endif
                                              @endforeach
                                          </td>
                                          <td>
                                              @if($medical->status == 'active')
                                                  <span class="badge badge-success">{{ $medical->status }}</span>
                                              @else
                                                  <span class="badge badge-warning">{{ $medical->status }}</span>
                                              @endif
                                          </td>
                                          <td>
                                              <a href="{{ route('medical_records.edit', $medical->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                              <form method="POST" action="{{ route('medical_records.destroy', $medical->id) }}" style="display: inline;">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="btn btn-danger btn-sm dltBtn" style="height: 30px; width: 30px; border-radius: 50%;" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                              </form>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      @else
                          <h6 class="text-center">No medical records found!!! Please add medical records.</h6>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    });
</script>
@endpush
