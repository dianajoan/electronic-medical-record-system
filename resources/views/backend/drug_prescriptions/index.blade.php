@extends('backend.layouts.master')

@section('title') Drug Prescriptions @endsection

@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Drug Prescriptions</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{ route('admin')}}">Dashboard</a></li>
                    <li><a href="{{ route('drug_prescriptions.create')}}"> Add Drug Prescriptions</a></li>
                    <li class="active">Drug Prescriptions</li>
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
                        <strong class="card-title">Drug Prescriptions</strong>
                    </div>
                    <div class="card-body">
                        @if(count($drugPrescriptions) > 0)
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Medical Record</th>
                                    <th>Patient</th>
                                    <th>Drugs</th>
                                    <th>Dosage Instructions</th>
                                    <th>Stock</th>
                                    <th>Prescription Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drugPrescriptions as $drugp)
                                <tr>
                                    <td>{{ $drugp->id }}</td>
                                    <td>{{ $drugp->medicalRecord->visit_date }}</td>
                                    <td>{{ $drugp->patient->first_name }}</td>
                                    <td>
                                        @foreach($drugp->drugs as $drug)
                                            {{ $drug->name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($drugp->dosage_instructions as $instruction)
                                            @foreach($drugp->drugs as $drug)
                                                @if($instruction['drug_id'] == $drug->id)
                                                    {{ $drug->name }}: {{ $instruction['instruction'] }}<br>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>{{ $drugp->stock == 'in_stock' ? 'Yes' : 'No' }}</td>
                                    <td>{{ $drugp->prescription_date}}</td>
                                    <td>
                                        @if($drugp->status == 'active')
                                            <span class="badge badge-success">{{ $drugp->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $drugp->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('drug_prescriptions.edit', $drugp->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('drug_prescriptions.destroy', $drugp->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm dltBtn" data-id="{{ $drugp->id }}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h6 class="text-center">No drug Prescriptions found!!! Please add drug Prescriptions</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

@endsection
