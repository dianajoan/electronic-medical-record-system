@extends('backend.layouts.master')

@section('title') Add Drug Prescriptions @endsection

@section('main-content')
    @include('backend.layouts.notification')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Add Drug Prescriptions</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                                <li><a href="{{ route('drug_prescriptions.index') }}">Drug Prescriptions</a></li>
                                <li class="active">Add Drug Prescriptions</li>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Add Drug Prescriptions</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="post" action="{{ route('drug_prescriptions.store') }}" enctype="multipart/form-data" id="drug-prescription-form">
                                @csrf

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
                                    <label for="patient_id">Patient <span class="text-danger">*</span></label>
                                    <select name="patient_id" id="patient_id" class="form-control" required>
                                        <option value="">Select Patient</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                                {{ $patient->first_name }} {{ $patient->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="medical_record_id">Medical Records <span class="text-danger">*</span></label>
                                    <select name="medical_record_id" class="form-control" required>
                                        <option value="">----</option>
                                        @foreach($medicalRecords as $record)
                                            <option value="{{ $record->id }}" {{ old('medical_record_id') == $record->id ? 'selected' : '' }}>
                                                {{ $record->symptoms }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('medical_record_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="drug_ids">Drugs <span class="text-danger">*</span></label>
                                    <select name="drug_ids[]" id="drug_ids" class="form-control" multiple required>
                                        @foreach($drugs as $drug)
                                            <option value="{{ $drug->id }}" {{ in_array($drug->id, old('drug_ids', [])) ? 'selected' : '' }}>
                                                {{ $drug->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('drug_ids')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock</label><br>
                                    <select name="stock" class="form-control" required>
                                        <option value="in_stock" {{ old('stock') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                        <option value="not_in_stock" {{ old('stock') == 'not_in_stock' ? 'selected' : '' }}>Not In Stock</option>
                                    </select>
                                    @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="dosage_instructions" class="col-form-label">Dosage Instructions</label>
                                    <div id="dosage-instructions-container">
                                        <div class="dosage-instruction">
                                            <select name="dosage_instructions[0][drug_id]" class="form-control mb-2" required>
                                                <option value="">Select Drug</option>
                                                @foreach($drugs as $drug)
                                                    <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                                                @endforeach
                                            </select>
                                            <textarea class="form-control" name="dosage_instructions[0][instruction]" rows="3" placeholder="Dosage Instructions" required></textarea>
                                            <button type="button" class="btn btn-sm btn-danger mt-2 remove-dosage-instruction">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-dosage-instruction">Add More Instructions</button>
                                    @error('dosage_instructions')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="prescription_date" class="col-form-label">Prescription Date <span class="text-danger">*</span></label>
                                    <input id="prescription_date" type="datetime-local" name="prescription_date" value="{{ old('prescription_date') }}" class="form-control" required>
                                    @error('prescription_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-dosage-instruction').addEventListener('click', function() {
            var container = document.getElementById('dosage-instructions-container');
            var index = container.children.length;
            var html = `<div class="dosage-instruction mt-2">
                            <select name="dosage_instructions[${index}][drug_id]" class="form-control mb-2" required>
                                <option value="">Select Drug</option>
                                @foreach($drugs as $drug)
                                <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                                @endforeach
                            </select>
                            <textarea class="form-control" name="dosage_instructions[${index}][instruction]" rows="3" placeholder="Dosage Instructions" required></textarea>
                            <button type="button" class="btn btn-sm btn-danger mt-2 remove-dosage-instruction">Remove</button>
                        </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });

        document.getElementById('dosage-instructions-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-dosage-instruction')) {
                e.target.closest('.dosage-instruction').remove();
            }
        });
    });
</script>
@endpush
