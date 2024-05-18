@extends('backend.layouts.master')
@section('title') {{ __('sidebar.dashboard') }} @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">


    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\Patient::countActivePatient()}}</span>
                </h4>
                <p class="text-light">Patients</p>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart1"></canvas> --}}
                </div>

            </div>

        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-2">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\MedicalRecord::countActiveMedical()}}</span>
                </h4>
                <p class="text-light">MedicalRecord</p>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart2"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\LabTest::countActiveLabTest()}}</span>
                </h4>
                <p class="text-light">LabTests</p>

                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart4"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-3">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton3" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\LabResult::countActiveLab()}}</span>
                </h4>
                <p class="text-light">Lab Results</p>

            </div>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                {{-- <canvas id="widgetChart3"></canvas> --}}
            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\LabTestOrder::countActiveLabTestOrder()}}</span>
                </h4>
                <p class="text-light">Lab Test Orders</p>

                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart4"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\Diagnosis::countActiveDiagnosis()}}</span>
                </h4>
                <p class="text-light">Diagnosis</p>

                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart4"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\Drug::countActiveDrug()}}</span>
                </h4>
                <p class="text-light">Drugs</p>

                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart4"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\DrugPrescription::countActiveDrug()}}</span>
                </h4>
                <p class="text-light">Drug Prescription</p>

                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart4"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\Clinic::countActiveClinic()}}</span>
                </h4>
                <p class="text-light">Clinics</p>

                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart4"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\Appointment::countActiveAppointment()}}</span>
                </h4>
                <p class="text-light">Appointment</p>

                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart4"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body pb-0">
                {{-- <div class="dropdown float-right">
                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                        <div class="dropdown-menu-content">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="mb-0">
                    <span class="count">{{\App\Models\User::countActiveUser()}}</span>
                </h4>
                <p class="text-light">Users</p>

                <div class="chart-wrapper px-3" style="height:70px;" height="70">
                    {{-- <canvas id="widgetChart4"></canvas> --}}
                </div>

            </div>
        </div>
    </div>
    <!--/.col-->

    

@endsection