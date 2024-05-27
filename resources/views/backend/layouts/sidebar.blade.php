<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('admin') }}"><img src="{{ asset('backend/images/logo.png') }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('admin') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-image"></i>Patients</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('patients.index') }}">View Patients</a></li>
                        <li><a href="{{ route('patients.create') }}">Add Patient</a></li>
                    </ul>
                </li>


                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Diagnosis</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('diagnosis.index') }}">View Diagnoses</a></li>
                        <li><a href="{{ route('diagnosis.create') }}">Add Diagnosis</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Clinics</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('clinics.index') }}">View Clinic</a></li>
                        <li><a href="{{ route('clinics.create') }}">Add Clinic</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Drugs</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('drugs.index') }}">View Drugs</a></li>
                        <li><a href="{{ route('drugs.create') }}">Add Drugs</a></li>
                        <li><a href="{{ route('drug_prescriptions.index') }}">View Drug Prescription</a></li>
                        <li><a href="{{ route('drug_prescriptions.create') }}">Add Drug Prescription</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Medical Records</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('medical_records.index') }}">View Medical Record</a></li>
                        <li><a href="{{ route('medical_records.create') }}">Add New</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Labs</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('lab_test_orders.index') }}">View Lab Test Orders</a></li>
                        <li><a href="{{ route('lab_test_orders.create') }}">Add Lab Test Order</a></li>
                        <li><a href="{{ route('lab_tests.index') }}">View Lab Tests</a></li>
                        <li><a href="{{ route('lab_tests.create') }}">Add Lab Test</a></li>
                        <li><a href="{{ route('lab_results.index') }}">View Lab Results</a></li>
                        <li><a href="{{ route('lab_results.create') }}">Add Lab Result</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Appointments</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('appointments.index') }}">View All</a></li>
                        <li><a href="{{ route('appointments.create') }}">Add New</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Settings</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><a href="{{ route('general_tests.index') }}">Manage General Tests</a></li>
                        <li><a href="{{ route('general_tests.create') }}">Add General Test</a></li>
                        <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                        <li><a href="{{ route('users.create') }}">Add User</a></li>
                        <li><a href="{{ route('roles.index') }}">Manage Roles</a></li>
                        <li><a href="{{ route('roles.create') }}">Add Roles</a></li>
                    </ul>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
