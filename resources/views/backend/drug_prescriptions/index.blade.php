@extends('backend.layouts.master')
@section('title') Drug @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Drug</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('drug_prescriptions.create')}}"> Add Drug</a></li>
                <li class="active">Drug</li>
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
                      <strong class="card-title">Drug</strong>
                  </div>
                  <div class="card-body">
                    @if(count($drugPrescriptions)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Medical Records</th>
                                <th>Instruction</th>
                                <th> Prescription</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($drugPrescriptions as $drug)
                              @php 
                                $medicalRecord=DB::table('medical_records')->select('visit_date')->where('id',$drug->medical_record_id)->get();
                              @endphp
                              <tr>
                                <td>{{$drug->id}}</td>
                                <td>
                                  @foreach($medicalRecord as $data)
                                    {{$drug->medicalRecord->visit_date}}
                                    @endforeach
                                </td>
                                <td>{{$drug->drug_name}}</td>
                                <td>{{$drug->dosage_instructions}}</td>
                                <td>{{$drug->prescription_date}}</td>
                                <td>
                                    @if($drug->status=='active')
                                        <span class="badge badge-success">{{$drug->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$drug->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('drug_prescriptions.edit',$drug->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('drug_prescriptions.destroy',[$drug->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$drug->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No drug found!!! Please add drug</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

