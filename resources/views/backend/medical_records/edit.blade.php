@extends('backend.layouts.master')
@section('title') Edit Medical Record @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit Medical Record</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('medical_records.index') }}">Medical Records</a></li>
                          <li class="active">Edit Medical Record</li>
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
                <strong>Edit Medical Record</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{ route('medical_records.update', $medical_record->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

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
                    <label for="patient_id">Patient<span class="text-danger">*</span></label>
                    <select name="patient_id" id="patient_id" class="form-control" required>
                        <option value="">Select Patient</option>
                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $medical_record->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="user_id">User<span class="text-danger">*</span></label>
                  <select name="user_id" id="user_id" class="form-control" required>
                      <option value="">Select User</option>
                      @foreach($users as $user)
                      <option value="{{ $user->id }}" {{ $medical_record->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                      @endforeach
                  </select>
                  @error('user_id')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

                <div class="form-group">
                    <label for="visit_date">Visit Date<span class="text-danger">*</span></label>
                    <input type="datetime-local" id="visit_date" name="visit_date" class="form-control" value="{{ $medical_record->visit_date }}" required>
                    @error('visit_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="primary_diagnosis_id">Primary Diagnosis<span class="text-danger">*</span></label>
                    <select name="primary_diagnosis_id" id="primary_diagnosis_id" class="form-control" required>
                        <option value="">Select Diagnosis</option>
                        @foreach($diagnoses as $diagnosis)
                        <option value="{{ $diagnosis->id }}" {{ $medical_record->primary_diagnosis_id == $diagnosis->id ? 'selected' : '' }}>
                            {{ $diagnosis->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('primary_diagnosis_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="secondary_diagnoses">Secondary Diagnoses</label>
                    <select name="secondary_diagnoses[]" id="secondary_diagnoses" class="form-control" multiple>
                        @foreach($diagnoses as $diagnosis)
                        <option value="{{ $diagnosis->id }}" {{ in_array($diagnosis->id, $medical_record->secondaryDiagnoses->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $diagnosis->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('secondary_diagnoses')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="symptoms">Symptoms<span class="text-danger">*</span></label>
                    <textarea id="symptoms" name="symptoms" class="form-control" required>{{ $medical_record->symptoms }}</textarea>
                    @error('symptoms')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="treatment_given">Treatment Given<span class="text-danger">*</span></label>
                    <textarea id="treatment_given" name="treatment_given" class="form-control ckeditor" required>{{ $medical_record->treatment_given }}</textarea>
                    @error('treatment_given')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="outcome">Outcome<span class="text-danger">*</span></label>
                    <select name="outcome" id="outcome" class="form-control" required>
                        <option value="admitted" {{ $medical_record->outcome == 'admitted' ? 'selected' : '' }}>Admitted</option>
                        <option value="died" {{ $medical_record->outcome == 'died' ? 'selected' : '' }}>Died</option>
                        <option value="referred" {{ $medical_record->outcome == 'referred' ? 'selected' : '' }}>Referred</option>
                        <option value="discharged" {{ $medical_record->outcome == 'discharged' ? 'selected' : '' }}>Discharged</option>
                    </select>
                    @error('outcome')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status<span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="active" {{ $medical_record->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $medical_record->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
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

@push('scripts')

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

@endpush