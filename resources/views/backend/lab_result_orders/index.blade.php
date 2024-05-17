@extends('backend.layouts.master')
@section('title') Lab Result Orders @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Lab Result Orders</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('lab_result_orders.create')}}"> Add Lab</a></li>
                <li class="active">Lab</li>
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
                      <strong class="card-title">Lab</strong>
                  </div>
                  <div class="card-body">
                    @if(count($labresultorders)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Patient</th>
                                <th>Medical Record</th>
                                <th>Lab Test</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($labresultorders as $labro)
                              @php 
                                $medicalRecord=DB::table('medical_records')->select('visit_date')->where('id',$labro->medical_record_id)->get();
                                $patient=DB::table('patients')->select('first_name')->where('id',$labro->patient_id)->get();
                                $labTest=DB::table('lab_tests')->select('name')->where('id',$labro->lab_test_id)->get();
                              @endphp
                              <tr>
                                <td>{{$labro->id}}</td>
                                <td>
                                  @foreach($patient as $data)
                                    {{$labro->patient->first_name}}
                                    @endforeach
                                </td>
                                <td>
                                  @foreach($medicalRecord as $data)
                                    {{$labro->medicalRecord->visit_date ?? ''}}
                                    @endforeach
                                </td>
                                <td>
                                  @foreach($labTest as $data)
                                    {{$labro->labTest->name ?? ''}}
                                    @endforeach
                                </td>
                                <td>
                                    @if($labro->status=='active')
                                        <span class="badge badge-success">{{$labro->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$labro->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('lab_result_orders.edit',$labro->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('lab_result_orders.destroy',[$labro->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$labro->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No lab results found!!! Please add lab result order</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

