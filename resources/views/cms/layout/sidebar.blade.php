<!--start sidebar-->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        {{-- <div class="logo-icon">
            <img src="{{ asset('dashboard/assets/images/logo-icon.png') }}" class="logo-img" alt="">
        </div> --}}
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0 text-center">{{ env('APP_NAME') }}</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            <li class="{{ Route::is('dashboard') ? 'mm-active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>

            @hasrole('admin|petugas-pendaftaran|pasien|dokter')
            <li class="menu-label">Service</li>
            @endhasrole
            @hasrole('admin|petugas-pendaftaran|pasien')
            <li class="{{ Route::is('registrations.*') ? 'mm-active' : '' }}">
                <a href="{{ route('registrations.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">app_registration</i>
                    </div>
                    <div class="menu-title">Registration</div>
                </a>
            </li>
            @endhasrole

            @hasrole('admin|dokter')
            <li class="{{ Route::is('medicalrecords.*') ? 'mm-active' : '' }}">
                <a href="{{ route('medicalrecords.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">note_add</i>
                    </div>
                    <div class="menu-title">Medical Record</div>
                </a>
            </li>
            @endhasrole

            @hasrole('admin|apoteker|dokter')
            <li class="{{ Route::is('prescriptions.*') ? 'mm-active' : '' }}">
                <a href="{{ route('prescriptions.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">medication</i>
                    </div>
                    <div class="menu-title">Prescription</div>
                </a>
            </li>
            @endhasrole

            @hasrole('admin|petugas-pendaftaran')
            <li class="menu-label">Master</li>
            @endhasrole
            @hasrole('admin|apoteker')
            <li class="{{ Route::is('medicines.*') ? 'mm-active' : '' }}">
                <a href="{{ route('medicines.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">medication</i>
                    </div>
                    <div class="menu-title">Medicine</div>
                </a>
            </li>
            @endhasrole

            @hasrole('admin')
            <li class="{{ Route::is('doctors.list.*') || Route::is('doctors.schedule.*') ? 'mm-active' : '' }}">
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">medical_information</i>
                    </div>
                    <div class="menu-title">Doctors</div>
                </a>
                <ul>
                    <li class="{{ Route::is('doctors.list.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('doctors.list') }}">
                            <i class="material-icons-outlined">arrow_right</i>
                            List
                        </a>
                    </li>
                    
                    <li class="{{ Route::is('doctors.schedule.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('doctors.schedule') }}">
                            <i class="material-icons-outlined">arrow_right</i>
                            Schedule
                        </a>
                    </li>
                </ul>
            </li>
            @endhasrole

            @hasrole('admin|petugas-pendaftaran')
            <li class="{{ Route::is('users.admin.*') || Route::is('users.patient.*') ? 'mm-active' : '' }}">
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">group</i>
                    </div>
                    <div class="menu-title">Users</div>
                </a>
                <ul>
                    @hasrole('admin')
                    <li class="{{ Route::is('users.admin.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('users.admin') }}">
                            <i class="material-icons-outlined">arrow_right</i>
                            Admin
                        </a>
                    </li>
                    @endhasrole

                    <li class="{{ Route::is('users.patient.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('users.patient') }}">
                            <i class="material-icons-outlined">arrow_right</i>
                            Patient
                        </a>
                    </li>
                    {{-- <li><a class="has-arrow" href="javascript:;"><i
                                class="material-icons-outlined">arrow_right</i>Basic</a>
                        <ul>
                            <li><a href="auth-basic-login.html" target="_blank"><i
                                        class="material-icons-outlined">arrow_right</i>Login</a></li>
                            <li><a href="auth-basic-register.html" target="_blank"><i
                                        class="material-icons-outlined">arrow_right</i>Register</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </li>
            @endhasrole
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->
