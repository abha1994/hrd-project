<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link">
      <img src="{{asset('public/assets/img/inlogo.png')}}" alt="HRD Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">HRD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    
	   <?php
	    $current_url =  Request::segment(1);
		$dashboardClass = $internshipMClass = $nternshipguidelinesMClass = $eligibleMClass = $applyMClass = $printMClass = $contactMClass = $statusMclass1  = '' ;
		if($current_url == 'home'){
		   $dashboardClass = 'active';
		}
		if($current_url == 'internship'){
		   $internshipMClass = 'active';
		}
		if($current_url == 'nternship-guidelines'){
		   $nternshipguidelinesMClass = 'active';
		}
		if($current_url == 'who-is-eligible'){
		   $eligibleMClass = 'active';
		}
		if($current_url == 'how-to-apply'  ){
		   $applyMClass = 'active';
		}
		if($current_url == 'internship-print' ){
		   $printMClass = 'active';
		}
		if($current_url == 'contact-us' ){
		   $contactMClass = 'active';
		}
		if($current_url == 'intern-status' ){
		   $statusMclass1 = 'active';
		}
	?>
	

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{ url('/home') }}" class="nav-link {{ $dashboardClass }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
             
          </li>
          
          <li class="nav-item">
            <a href="{{ URL('internship')}}" class="nav-link {{ $internshipMClass }}" id="liRole">
              <i class="nav-icon fas fa-th"></i>
              <p>
                 Internship Form
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
           
          <li class="nav-item">
            <a href="{{ url('internship-guidelines') }}"   target="_blank" class="nav-link {{ $nternshipguidelinesMClass }}" id="listudent">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Detailed Guidelines
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{URL('who-is-eligible')}}" class="nav-link {{ $eligibleMClass }}" id="libank">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Who is Eligible
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ url('how-to-apply')}}" class="nav-link {{ $applyMClass }}" id="liuser">
              <i class="nav-icon fas fa-user"></i>
              How to Apply
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
		  
		   <li class="nav-item">
            <a href="{{ url('internship-print')}}" class="nav-link {{ $printMClass }}" id="liuser">
              <i class="nav-icon fas fa-user"></i>
               Print Application
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
		  
		   <li class="nav-item">
            <a href="{{ url('contact-us')}}" class="nav-link {{ $contactMClass }}" id="liuser">
              <i class="nav-icon fas fa-user"></i>
              Contact Us
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
		  <?php $candidate_id = Auth::user()->id;?>
		   <li class="nav-item">
            <a href="{{ URL('intern-status')}}/<?php echo $candidate_id;?>" class="nav-link {{ $statusMclass1 }}" id="liuser">
              <i class="nav-icon fas fa-user"></i>
             Check Status
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