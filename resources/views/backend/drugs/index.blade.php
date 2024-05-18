@extends('backend.layouts.master')
@section('title') Drugs @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Drugs</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('drugs.create')}}"> Add Drug</a></li>
                <li class="active">Drugs</li>
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
                      <strong class="card-title">Drugs</strong>
                  </div>
                  <div class="card-body">
                    @if(count($drugs)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Brand Name</th>
                                <th>Form</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($drugs as $drug)
                              <tr>
                                <td>{{$drug->id}}</td>
                                <td>{{$drug->name}}</td>
                                <td>{{$drug->brand_name}}</td>
                                <td>{{$drug->form}}</td>
                                <td>{{$drug->code}}</td>
                                <td>
                                    @if($drug->status=='active')
                                        <span class="badge badge-success">{{$drug->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$drug->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('drugs.edit',$drug->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('drugs.destroy',[$drug->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$drug->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No drugs found!!! Please add drug</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

