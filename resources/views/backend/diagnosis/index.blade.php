@extends('backend.layouts.master')
@section('title') Diagnoses @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Diagnoses</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('diagnosis.create')}}"> Add Diagnoses</a></li>
                <li class="active">Diagnoses</li>
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
                      <strong class="card-title">Diagnoses</strong>
                  </div>
                  <div class="card-body">
                    @if(count($diagnosis)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>ICD Code</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($diagnosis as $diag)
                              <tr>
                                <td>{{$diag->id}}</td>
                                <td>{{$diag->name}}</td>
                                <td>{{$diag->icd_code}}</td>
                                <td>
                                    @if($diag->status=='active')
                                        <span class="badge badge-success">{{$diag->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$diag->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('diagnosis.edit',$diag->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('diagnosis.destroy',[$diag->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$diag->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No diagnosis found!!! Please add diagnosis</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

