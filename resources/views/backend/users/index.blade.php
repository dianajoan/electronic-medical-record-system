@extends('backend.layouts.master')
@section('title') Users @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Users</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('users.create')}}"> Add User</a></li>
                <li class="active">Users</li>
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
                      <strong class="card-title">Users</strong>
                  </div>
                  <div class="card-body">
                    @if(count($users)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>{{ __('sidebar.user_number') }}</th>
                                <th>{{ __('sidebar.user_name') }}</th>
                                <th>{{ __('sidebar.user_email') }}</th>
                                <th>{{ __('sidebar.user_photo') }}</th>
                                <th>{{ __('sidebar.user_joined_date') }}</th>
                                <th>{{ __('sidebar.user_role') }}</th>
                                <th>{{ __('sidebar.user_status') }}</th>
                                <th>{{ __('sidebar.user_action') }}</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($users as $user)
                              <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->photo)
                                        <img src="{{ Storage::url($user->photo) }}" class="img-fluid rounded-circle" style="max-width:50px" alt="{{ Storage::url($user->photo) }}">
                                    @else
                                        <img src="{{asset('backend/img/avatar.png')}}" class="img-fluid rounded-circle" style="max-width:50px" alt="avatar.png">
                                    @endif
                                </td>
                                <td>{{(($user->created_at)? $user->created_at->diffForHumans() : '')}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    @if($user->status=='active')
                                        <span class="badge badge-success">{{$user->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$user->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                <form method="POST" action="{{route('users.destroy',[$user->id])}}">
                                  @csrf 
                                  @method('delete')
                                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$user->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No users found!!! Please add user</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->
      
@endsection

