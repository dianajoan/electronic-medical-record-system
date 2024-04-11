@extends('backend.layouts.master')
@section('title') Medical Records @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Medical</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('medical_records.create')}}"> Add Medical Records</a></li>
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
                      <strong class="card-title">Medical</strong>
                  </div>
                  <div class="card-body">
                    @if(count($medicalRecords)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Patient</th>
                                <th>Visit Date</th>
                                <th>Chief Complaint</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($medicalRecords as $medical)
                              @php 
                                $patient=DB::table('patients')->select('first_name')->where('id',$medical->patient_id)->get();
                              @endphp
                              <tr>
                                <td>{{$medical->id}}</td>
                                <td>
                                  @foreach($patient as $data)
                                    {{$medical->patient->first_name}}
                                    @endforeach
                                </td>
                                <td>{{$medical->visit_date}}</td>
                                <td>{{$medical->chief_complaint}}</td>
                                <td>
                                    @if($medical->status=='active')
                                        <span class="badge badge-success">{{$medical->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$medical->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('medical_records.edit',$medical->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('medical_records.destroy',[$medical->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$medical->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No medical records found!!! Please add medical records</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

