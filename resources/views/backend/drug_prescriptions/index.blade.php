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
                    @if(count($drugPrescriptions)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Medical Records</th>
                                <th>Patients</th>
                                <th>Drugs</th>
                                <th>Stock</th>
                                <th>Prescription</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($drugPrescriptions as $drugp)
                              @php 
                                $medicalRecord=DB::table('medical_records')->select('visit_date')->where('id',$drugp->medical_record_id)->get();
                                $patient=DB::table('patients')->select('first_name')->where('id',$drugp->patient_id)->get();
                                $drug=DB::table('drugs')->select('name')->where('id',$drugp->drug_id)->get();
                              @endphp
                              <tr>
                                <td>{{$drugp->id}}</td>
                                <td>
                                  @foreach($medicalRecord as $data)
                                    {{$drugp->medicalRecord->visit_date}}
                                    @endforeach
                                </td>
                                <td>
                                  @foreach($patient as $data)
                                    {{$drugp->patient->first_name}}
                                    @endforeach
                                </td>
                                <td>
                                  @foreach($drug as $data)
                                    {{$drugp->drug->name}}
                                    @endforeach
                                </td>
                                <td>{{(($drugp->stock==1)? 'Yes': 'No')}}</td>
                                <td>{{$drugp->prescription_date}}</td>
                                <td>
                                    @if($drugp->status=='active')
                                        <span class="badge badge-success">{{$drugp->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$drugp->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('drug_prescriptions.edit',$drugp->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('drug_prescriptions.destroy',[$drugp->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$drugp->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No drug Prescription found!!! Please add drug Prescription</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

