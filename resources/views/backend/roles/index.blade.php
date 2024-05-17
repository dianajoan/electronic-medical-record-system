@extends('backend.layouts.master')
@section('title') User Roles @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>User Roles</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('roles.create')}}"> Add User Role</a></li>
                <li class="active">User Roles</li>
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
                      <strong class="card-title">User Roles</strong>
                  </div>
                  <div class="card-body">
                    @if(count($roles)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Users</th>
                                <th>Name</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($roles as $rol)
                              @php 
                                $user=DB::table('users')->select('name')->where('id',$rol->user_id)->get();
                              @endphp
                              <tr>
                                <td>{{$rol->id}}</td>
                                <td>
                                  @foreach($user as $data)
                                    {{$rol->user->name}}
                                    @endforeach
                                </td>
                                <td>{{$rol->name}}</td>
                                <td>
                                    @if($rol->role=='admin')
                                        <span class="badge badge-success">{{$rol->role}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$rol->role}}</span>
                                    @endif
                                </td>
                                <td>
                                  @if($rol->status=='active')
                                      <span class="badge badge-success">{{$rol->status}}</span>
                                  @else
                                      <span class="badge badge-warning">{{$rol->status}}</span>
                                  @endif
                              </td>
                                <td>
                                  <a href="{{route('roles.edit',$rol->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('roles.destroy',[$rol->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$rol->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No roles found!!! Please add role</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

