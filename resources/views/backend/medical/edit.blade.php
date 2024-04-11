@extends('backend.layouts.master')
@section('title') Edit Testimonial @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit Testimonial</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('testimonial.index') }}">Testimonial</a></li>
                          <li class="active">Edit Testimonial</li>
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
                <strong>Edit Testimonial</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{route('testimonial.update',$testimonial->id)}}" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Members Name <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" placeholder=""  value="{{$testimonial->name}}" class="form-control" required>
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="client_id">Client <span class="text-danger">*</span></label>
                  <select name="client_id" class="form-control" required>
                      <option value="">----</option>
                      @foreach($clients as $key=>$data)
                          <option value='{{$data->id}}' {{(($data->id==$testimonial->client_id)? 'selected' : '')}}>{{$data->name}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Position <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="position" placeholder=""  value="{{$testimonial->position}}" class="form-control" required>
                    @error('position')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="inputDesc" class="col-form-label">Message</label>
                  <textarea class="form-control" id="comment" name="message" required>{{$testimonial->message}}</textarea>
                  @error('message')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
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
                  <input class="form-control" type="file" name="photo" value="{{$testimonial->photo}}">
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                  @error('photo')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <img src="{{ Storage::url($testimonial->photo) }}" height="75" width="75" alt="" />
                </div>
                
                <div class="form-group">
                  <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control" required>
                    <option value="active" {{(($testimonial->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($testimonial->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css">

<style>
  #left-panel {
      background-color: #272c33;
  }

  #left-panel .navbar-default {
      background-color: #272c33;
      border-color: #272c33;
  }
</style>

@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#comment').summernote({
            placeholder: "Write detail Message.....",
            tabsize: 2,
            height: 150
        });
    });
</script>
@endpush