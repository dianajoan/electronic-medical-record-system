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
                    @if(count($appointments)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Medical Record</th>
                                <th>Patient</th>
                                <th>Clinic</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($appointments as $appointment)
                              @php 
                                $medicalRecord=DB::table('medical_records')->select('visit_date')->where('id',$appointment->medical_record_id)->get();
                                $patient=DB::table('patients')->select('first_name')->where('id',$appointment->patient_id)->get();
                                $clinic=DB::table('clinics')->select('name')->where('id',$appointment->clinic_id)->get();
                              @endphp
                              <tr>
                                <td>{{$appointment->id}}</td>
                                <td>
                                  @foreach($medicalRecord as $data)
                                    {{$appointment->medicalRecord->visit_date}}
                                    @endforeach
                                </td>
                                <td>
                                  @foreach($patient as $data)
                                    {{$appointment->patient->first_name}}
                                    @endforeach
                                </td>
                                <td>
                                  @foreach($clinic as $data)
                                    {{$appointment->clinic->name}}
                                    @endforeach
                                </td>
                                <td>{{$appointment->name}}</td>
                                <td>{{$appointment->date}}</td>
                                <td>{{$appointment->time}}</td>
                                <td>
                                    @if($appointment->status=='postponded')
                                        <span class="badge badge-success">{{$appointment->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$appointment->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('appointments.edit',$appointment->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('appointments.destroy',[$appointment->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$appointment->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No appointments found!!! Please add appointment</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

