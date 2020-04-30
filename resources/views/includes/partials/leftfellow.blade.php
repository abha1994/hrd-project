<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link">
      <img src="{{asset('public/assets/img/inlogo.png')}}" alt="HRD Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">HRD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{ url('/home') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
             
          </li>
          
          <li class="nav-item">
            <a href="{{ url('fellowship-solar-form/create')}}" class="nav-link" id="liRole">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Fellowship Solar Form.
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
           
          <li class="nav-item">
            <a href="{{ url('bank-details')}}" class="nav-link" id="listudent">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Bank Details
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>