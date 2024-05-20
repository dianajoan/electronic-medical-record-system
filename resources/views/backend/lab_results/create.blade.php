@extends('backend.layouts.master')
@section('title') Add Lab Results @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Add Lab Results</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin') }}">Dashboard</a></li>
                          <li><a href="{{ route('lab_results.index') }}">Lab</a></li>
                          <li class="active">Add Lab</li>
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
                <strong>Lab</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{ route('lab_results.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                  <label for="lab_test_order_id">Lab Test Order<span class="text-danger">*</span></label>
                  <select name="lab_test_order_id" class="form-control" required>
                      <option value="">----</option>
                      @foreach($labTestOrders as $key => $data)
                          <option value="{{ $data->id }}">{{ $data->test_name }}</option>
                      @endforeach
                  </select>
                  @error('lab_test_order_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="authenticated_by">Authenticated By<span class="text-danger">*</span></label>
                  <select name="authenticated_by" class="form-control" required>
                      <option value="">----</option>
                      @foreach($users as $key => $data)
                          <option value="{{ $data->id }}">{{ $data->name }}</option>
                      @endforeach
                  </select>
                  @error('authenticated_by')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="result_details" class="col-form-label">Result Details</label>
                  <textarea class="form-control ckeditor" id="result_details" name="result_details" required>{{ old('result_details') }}</textarea>
                  @error('result_details')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="result_date" class="col-form-label">Result Date <span class="text-danger">*</span></label>
                  <input id="result_date" type="datetime-local" name="result_date" value="{{ old('result_date') }}" class="form-control" required>
                  @error('result_date')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="status" class="col-form-label">Status<span class="text-danger">*</span></label>
                  <select name="status" class="form-control" required>
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
                  </select>
                  @error('status')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group mb-3">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button class="btn btn-success" type="submit">Submit</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

@endpush