@extends('backend.layouts.master')
@section('title') Testimonials @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Testimonials</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('testimonial.create')}}"> Add Testimonials</a></li>
                <li class="active">Testimonials</li>
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
                      <strong class="card-title">Testimonials</strong>
                  </div>
                  <div class="card-body">
                    @if(count($testimonials)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Client</th>
                                <th>Position</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($testimonials as $testimonial)
                              @php 
                                $client_info=DB::table('clients')->select('name')->where('id',$testimonial->client_id)->get();
                              @endphp
                              <tr>
                                <td>{{$testimonial->id}}</td>
                                <td>{{$testimonial->name}}</td>
                                <td>
                                  @foreach($client_info as $data)
                                    {{$testimonial->client_info->name}}
                                    @endforeach
                                </td>
                                <td>{{$testimonial->position}}</td>
                                <td>
                                    @if($testimonial->photo)
                                        <img src="{{ Storage::url($testimonial->photo) }}" class="img-fluid zoom" style="max-width:80px" alt="{{ Storage::url($testimonial->photo) }}">
                                    @else
                                        <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                                    @endif
                                </td>
                                <td>
                                    @if($testimonial->status=='active')
                                        <span class="badge badge-success">{{$testimonial->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$testimonial->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('testimonial.edit',$testimonial->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('testimonial.destroy',[$testimonial->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$testimonial->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No testimonials found!!! Please add testimonial</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

