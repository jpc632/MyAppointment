
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="white" >
          <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
              MyAppointment
            </a></div>
          <div class="sidebar-wrapper">
            <ul class="nav" id="sidebar">
              <li class="nav-item {{ Request::path() === 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                  <i class="material-icons">dashboard</i>
                  <p>Dashboard</p>
                </a>
              </li>
              @if(Auth::user()->role->name == 'admin')
                <li class="nav-item {{ Request::path() === 'staff/create' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('staff.create') }}">
                    <i class="material-icons">person</i>
                    <p>Create User</p>
                  </a>
                </li>
                <li class="nav-item {{ Request::path() === 'staff' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('staff.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Staff Management</p>
                  </a>
                </li>
              @endif
              @if(Auth::user()->role->name == 'doctor')
                <li class="nav-item {{ Request::path() === 'appointment' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('appointment.view') }}">
                  <i class="material-icons">library_books</i>
                  <p>Appointments</p>
                </a>
                </li>
                <li class="nav-item {{ Request::path() === 'availability' || Request::path() === 'availability/' . Auth::user()->id . '/show'  ? 'active' : '' }}">
                  <a class="nav-link " href="{{ route('availability.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Shift Management</p>
                  </a>
                </li>
                <li class="nav-item {{ Request::path() === 'availability/create' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('availability.create') }}">
                    <i class="material-icons">person</i>
                    <p>Availability</p>
                  </a>
                </li>
              @endif
            </ul>
          </div>
        </div>
