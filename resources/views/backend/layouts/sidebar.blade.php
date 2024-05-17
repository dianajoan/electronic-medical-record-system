<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{route('admin')}}"><img src="{{ asset('backend/images/logo.png') }}" alt="Logo"></a>
            {{-- <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a> --}}
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{route('admin')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <li>
                    <a href="{{route('patients.index')}}"> <i class="menu-icon fa fa-image"></i>Patients </a>
                </li>
                <li>
                    <a href="{{route('medical_records.index')}}"> <i class="menu-icon fa fa-file"></i>Medical Records </a>
                </li>
                <li>
                    <a href="{{route('lab_tests.index')}}"> <i class="menu-icon fa fa-file"></i>Lab Tests </a>
                </li>
                <li>
                    <a href="{{route('lab_results.index')}}"> <i class="menu-icon fa fa-folder"></i>Lab Results </a>
                </li>
                <li>
                    <a href="{{route('lab_test_orders.index')}}"> <i class="menu-icon fa fa-folder"></i>Lab Test Orders </a>
                </li>
                <li>
                    <a href="{{route('lab_result_orders.index')}}"> <i class="menu-icon fa fa-folder"></i>Lab Result Orders </a>
                </li>
                <li>
                    <a href="{{route('diagnosis.index')}}"> <i class="menu-icon fa fa-folder"></i>Diagnosis </a>
                </li>
                <li>
                    <a href="{{route('drugs.index')}}"> <i class="menu-icon fa fa-folder"></i>Drugs </a>
                </li>
                <li>
                    <a href="{{route('drug_prescriptions.index')}}"> <i class="menu-icon fa fa-user"></i>Drug Prescriptions </a>
                </li>
                <li>
                    <a href="{{route('clinics.index')}}"> <i class="menu-icon fa fa-folder"></i>Clinics </a>
                </li>
                <li>
                    <a href="{{route('appointments.index')}}"> <i class="menu-icon fa fa-folder"></i>Appointments </a>
                </li>
                <li>
                    <a href="{{route('users.index')}}"> <i class="menu-icon fa fa-user"></i>Users </a>
                </li>
                <li>
                    <a href="{{route('roles.index')}}"> <i class="menu-icon fa fa-user"></i>User Roles </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>