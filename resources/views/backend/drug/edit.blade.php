@extends('backend.layouts.master')
@section('title') Edit Team @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('team.index') }}">Team</a></li>
                          <li class="active">Edit</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <strong>Edit</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{route('team.update',$team->id)}}" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Member Name <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" placeholder=""  value="{{$team->name}}" class="form-control" required>
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Country <span class="text-danger">*</span></label>
                  <input id="inputTitle" type="text" name="country" placeholder=""  value="{{$team->country}}" class="form-control" required>
                  @error('country')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>

                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Position Held <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="position" placeholder=""  value="{{$team->position}}" class="form-control" required>
                    @error('position')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="event_cat_id">Team Category<span class="text-danger">*</span></label>
                  <select name="team_category_id" class="form-control" required>
                      <option value="">----</option>
                      @foreach($teamcategories as $key=>$data)
                          <option value='{{$data->id}}' {{(($data->id==$team->team_category_id)? 'selected' : '')}}>{{$data->title}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                <label for="inputPhoto" class="col-form-label">Upload Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                    {{-- <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$banner->photo}}"> --}}
                  <input class="form-control" type="file" name="photo" value="{{$team->photo}}">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                  @error('photo')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <img src="{{ Storage::url($team->photo) }}" height="75" width="75" alt="" />
                </div>

                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Email <span class="text-danger">*</span></label>
                  <input id="inputTitle" type="text" name="email" placeholder=""  value="{{$team->email}}" class="form-control">
                  @error('email')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>

              <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Contacts <span class="text-danger">*</span></label>
                  <input id="inputTitle" type="text" name="phone" placeholder=""  value="{{$team->phone}}" class="form-control">
                  @error('phone')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
              </div>
                
                <div class="form-group">
                  <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control" required>
                    <option value="active" {{(($team->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($team->status=='inactive') ? 'selected' : '')}}>Inactive</option>
                  </select>
                  @error('status')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <button class="btn btn-success" type="submit">Update</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection