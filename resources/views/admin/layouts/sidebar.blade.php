
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="white" >
          <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
    
            Tip 2: you can also add an image using data-image tag
        -->
          <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
              MyAppointment
            </a></div>
          <div class="sidebar-wrapper">
            <ul class="nav">
              <li class="nav-item active  ">
                <a class="nav-link" href="{{ url('dashboard') }}">
                  <i class="material-icons">dashboard</i>
                  <p>Dashboard</p>
                </a>
              </li>
              @if(Auth::user()->role->name == 'admin')
                <li class="nav-item ">
                  <a class="nav-link" href="{{ route('staff.create') }}">
                    <i class="material-icons">person</i>
                    <p>Create User</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="{{ route('staff.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Staff Management</p>
                  </a>
                </li>
              @endif
              @if(Auth::user()->role->name == 'doctor')
                <li class="nav-item ">
                <a class="nav-link" href="{{ route('appointment.view') }}">
                  <i class="material-icons">library_books</i>
                  <p>Appointments</p>
                </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="{{ route('availability.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Shift Management</p>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="{{ route('availability.create') }}">
                    <i class="material-icons">person</i>
                    <p>Availability</p>
                  </a>
                </li>
              @endif
              
              <li class="nav-item ">
                <a class="nav-link" href="./icons.html">
                  <i class="material-icons">bubble_chart</i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="./map.html">
                  <i class="material-icons">location_ons</i>
                  <p>Maps</p>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="./notifications.html">
                  <i class="material-icons">notifications</i>
                  <p>Notifications</p>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="./rtl.html">
                  <i class="material-icons">language</i>
                  <p>RTL Support</p>
                </a>
              </li>
              
            </ul>
          </div>
        </div>
