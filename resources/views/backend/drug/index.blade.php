@extends('backend.layouts.master')
@section('title') Teams @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Terms</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('team.create')}}"> Add Term</a></li>
                <li class="active">Teams</lierms>
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
                      <strong class="card-title">Terms</strong>
                  </div>
                  <div class="card-body">
                    @if(count($teams)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Category</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($teams as $team)
                              @php 
                                $teamcat_info=DB::table('team_categories')->select('title')->where('id',$team->team_category_id)->get();
                              @endphp
                              <tr>
                                <td>{{$team->id}}</td>
                                <td>{{$team->name}}</td>
                                <td>{{$team->email}}</td>
                                <td>
                                  @foreach($teamcat_info as $data)
                                    {{$team->teamcat_info->title}}
                                    @endforeach
                                </td>
                                <td>
                                    @if($team->photo)
                                        <img src="{{ Storage::url($team->photo) }}" class="img-fluid zoom" style="max-width:80px" alt="{{ Storage::url($team->photo) }}">
                                    @else
                                        <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                                    @endif
                                </td>
                                <td>
                                    @if($team->status=='active')
                                        <span class="badge badge-success">{{$team->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$team->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('team.edit',$team->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('team.destroy',[$team->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$team->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No teams found!!! Please add team</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

