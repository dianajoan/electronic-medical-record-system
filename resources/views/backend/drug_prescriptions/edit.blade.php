@extends('backend.layouts.master')

@section('title') Edit Drug Prescriptions @endsection

@section('main-content')
    @include('backend.layouts.notification')

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Edit Drug Prescriptions</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                                <li><a href="{{ route('drug_prescriptions.index') }}">Drug Prescriptions</a></li>
                                <li class="active">Edit Drug Prescriptions</li>
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
                            <strong>Edit Drug Prescriptions</strong>
                        </div>
                        <div class="card-body card-block">
                            <form method="post" action="{{ route('drug_prescriptions.update', $drugPrescription->id) }}" enctype="multipart/form-data" id="drug-prescription-form">
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
                                    <label for="patient_id">Patient <span class="text-danger">*</span></label>
                                    <select name="patient_id" id="patient_id" class="form-control" required>
                                        <option value="">Select Patient</option>
                                        @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ $drugPrescription->patient_id == $patient->id ? 'selected' : '' }}>
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
                                        <option value="{{ $record->id }}" {{ $drugPrescription->medical_record_id == $record->id ? 'selected' : '' }}>
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
                                        <option value="{{ $drug->id }}" {{ in_array($drug->id, $drugPrescription->drugs->pluck('id')->toArray()) ? 'selected' : '' }}>
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
                                        <option value="in_stock" {{ $drugPrescription->stock == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                        <option value="not_in_stock" {{ $drugPrescription->stock == 'not_in_stock' ? 'selected' : '' }}>Not In Stock</option>
                                    </select>
                                    @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="dosage_instructions" class="col-form-label">Dosage Instructions</label>
                                    <div id="dosage-instructions-container">
                                        @foreach($drugPrescription->dosage_instructions ?? [] as $index => $instruction)
                                        <div class="dosage-instruction mt-2">
                                            <select name="dosage_instructions[{{ $index }}][drug_id]" class="form-control mb-2" required>
                                                <option value="">Select Drug</option>
                                                @foreach($drugs as $drug)
                                                <option value="{{ $drug->id }}" {{ isset($instruction['drug_id']) && $drug->id == $instruction['drug_id'] ? 'selected' : '' }}>
                                                    {{ $drug->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <textarea class="form-control" name="dosage_instructions[{{ $index }}][instruction]" rows="3" placeholder="Dosage Instructions" required>{{ $instruction['instruction'] ?? '' }}</textarea>
                                            <button type="button" class="btn btn-sm btn-danger mt-2 remove-dosage-instruction">Remove</button>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-dosage-instruction">Add More Instructions</button>
                                    @error('dosage_instructions.*.instruction')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                              
                                                          
                                <div class="form-group">
                                    <label for="prescription_date" class="col-form-label">Prescription Date <span class="text-danger">*</span></label>
                                    <input id="prescription_date" type="datetime-local" name="prescription_date" value="{{ $drugPrescription->prescription_date->format('Y-m-d\TH:i') }}" class="form-control" required>
                                    @error('prescription_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" required>
                                        <option value="active" {{ $drugPrescription->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $drugPrescription->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <button class="btn btn-success" type="submit">Update</button>
                                    <a href="{{ route('drug_prescriptions.index') }}" class="btn btn-secondary">Cancel</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Remove dosage instruction
        $(document).on('click', '.remove-dosage-instruction', function() {
            $(this).closest('.dosage-instruction').remove();
        });

        // Add more dosage instructions
        $('#add-dosage-instruction').click(function() {
            var index = $('.dosage-instruction').length;
            var html = '<div class="dosage-instruction mt-2">';
            html += '<select name="dosage_instructions[' + index + '][drug_id]" class="form-control mb-2" required>';
            html += '<option value="">Select Drug</option>';
            @foreach($drugs as $drug)
                html += '<option value="{{ $drug->id }}">{{ $drug->name }}</option>';
            @endforeach
            html += '</select>';
            html += '<textarea class="form-control" name="dosage_instructions[' + index + '][instruction]" rows="3" placeholder="Dosage Instructions" required></textarea>';
            html += '<button type="button" class="btn btn-sm btn-danger mt-2 remove-dosage-instruction">Remove</button>';
            html += '</div>';
            $('#dosage-instructions-container').append(html);
        });

        // Ensure that dynamically added remove buttons work
        $(document).on('click', '.remove-dosage-instruction', function() {
            $(this).closest('.dosage-instruction').remove();
        });
    });
</script>
@endpush
