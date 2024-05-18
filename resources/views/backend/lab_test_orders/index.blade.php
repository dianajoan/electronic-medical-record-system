@extends('backend.layouts.master')
@section('title') Lab Test Orders @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Lab Test Orders</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('lab_test_orders.create')}}"> Add Lab</a></li>
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
                    @if(count($labtestorders)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Medical Record</th>
                                <th>User</th>
                                <th>General Test</th>
                                <th>Test Name</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($labtestorders as $labto)
                              @php 
                                $medicalRecord=DB::table('medical_records')->select('visit_date')->where('id',$labto->medical_record_id)->get();
                                $orderedByUser=DB::table('users')->select('name')->where('id',$labto->ordered_by)->get();
                                $genTest=DB::table('general_tests')->select('name')->where('id',$labto->general_test_id)->get();
                              @endphp
                              <tr>
                                <td>{{$labto->id}}</td>
                                <td>
                                  @foreach($medicalRecord as $data)
                                    {{$labto->medicalRecord->visit_date}}
                                    @endforeach
                                </td>
                                <td>
                                  @foreach($orderedByUser as $data)
                                    {{$labto->user->name}}
                                    @endforeach
                                </td>
                                <td>
                                  @foreach($genTest as $data)
                                    {{$labto->genTest->name}}
                                    @endforeach
                                </td>
                                <td>{{$labto->test_name}}</td>
                                <td>
                                    @if($labto->status=='active')
                                        <span class="badge badge-success">{{$labto->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$labto->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('lab_test_orders.edit',$labto->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('lab_test_orders.destroy',[$labto->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$labto->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No lab test order found!!! Please add lab test order</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

