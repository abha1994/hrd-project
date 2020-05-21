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
		$dashboardClass = $roleMClass = $userMClass = $officerMClass = $intershipMClass = $nrefMClass = $nresMClass = $nrestMClass ='' ;
		if($current_url == 'home'){
		   $dashboardClass = 'active';
		}
		if($current_url == 'roles'){
		   $roleMClass = 'active';
		}
		if($current_url == 'users'){
		   $userMClass = 'active';
		}
		if($current_url == 'user'){
		   $officerMClass = 'active';
		}
		if($current_url == 'admin-internship' || $current_url == 'considered-internship' || $current_url == 'rejected-internship' || $current_url == 'selecteded-internship' || $current_url == 'internship-home' || $current_url == 'forward-to-committee' || $current_url == 'selected-internship' ){
		   $intershipMClass = 'active';
		}
		if($current_url == 'university' || $current_url == 'universityCons' || $current_url == 'universityNocons' || $current_url == 'universityConsAdmin' || $current_url == 'universitySelected'|| $current_url == 'nref-home'  || $current_url == 'attendanceAdmin' || $current_url == 'fund-transfer' || $current_url == 'application-processed'|| $current_url == 'get-institute'|| $current_url == 'admin-student-considered'|| $current_url == 'admin-student-rejected' || $current_url == 'admin-student-forward-to-committee'|| $current_url == 'admin-student-final-rejected'|| $current_url == 'admin-student-final-selected' || $current_url == 'admin-student-committee-rec'){
		   $nrefMClass = 'active';
		}
		if($current_url == 'nres-home' ){
		   $nresMClass = 'active';
		}
		if($current_url == 'nrest-home' ){
		   $nrestMClass = 'active';
		}
		if($current_url == 'nrest-participants' ){
		   $nrestpMClass = 'active';
		}
	?>
	<?php  //dd($current_url); die;?>	  
		  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{ url('/home') }}" class="nav-link {{$dashboardClass}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
          @can('role-list')
          <li class="nav-item">
            <a href="{{url('roles')}}" class="nav-link {{$roleMClass}}" id="liRole">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Role Management
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @endcan
     
          @can('bankdetail-list')
          <li class="nav-item">
            <a href="{{url('bank-details')}}" class="nav-link" id="libank">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Bank Detail
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @endcan
          @can('user-list')
          <!--li class="nav-item">
            <a href="{{url('users')}}" class="nav-link {{$userMClass}}" id="liuser">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User Management
              </p>
            </a>
          </li-->
          @endcan
          @can('officer-list')
          <li class="nav-item has-treeview"  id="liofficer">
            <a href="#" class="nav-link {{$officerMClass}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Officer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" id="ulofficer">
              <li class="nav-item">
                <a href="{{ url('/user')}}" class="nav-link {{$officerMClass}}" id="liofficers">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Officers</p>
                </a>
              </li>
              <!--li class="nav-item">
                <a href="{{ url('link-officer')}}" class="nav-link">
                   <i class="nav-icon fas fa-user"></i>
                  <p>Link Officer</p>
                </a>
              </li-->
             </ul>
          </li>
          @endcan
		   @can('user-list')
          <li class="nav-item">
            <a href="{{url('fellowamount-list')}}" class="nav-link {{$userMClass}}" id="fellowamount">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Fellow Amount
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          @endcan
	     <?php $menu_id = Session::get('menu_id');
		 // dd($menu_id);
		 if($menu_id == "1" || $menu_id == null){?>
		 <!----------------------Scheme Code 1------------------------->
	     @if(Gate::check('admin-internship-list') || Gate::check('considered-internship-by-level1-list') || Gate::check('rejected-internship-list') || Gate::check('forward-to-committee-internship-list') || Gate::check('Selected-internship-list'))
          <li class="nav-item has-treeview"  id="liofficer">
            <a href="#" class="nav-link {{$intershipMClass}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Internship
                <i class="fas fa-angle-left right"></i>
             </p>
            </a>
            <ul class="nav nav-treeview" id="ulofficer">
			<li class="nav-item">
                <a href="{{ url('internship-home')}}" class="nav-link <?php if($current_url == 'internship-home') {echo "active";}else{ echo "";} ?>" id="liofficers3">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Internship Dashboard</p>
                </a>
              </li>
			 @can('admin-internship-list')
			 <li class="nav-item">
                <a href="{{ url('admin-internship')}}" class="nav-link <?php if($current_url == 'admin-internship') {echo "active";}else{ echo "";} ?>" id="liofficers3">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Pending Application</p>
                </a>
              </li>
			  @endcan
			   @can('considered-internship-by-level1-list')
              <li class="nav-item">
                <a href="{{ url('considered-internship')}}" class="nav-link <?php if($current_url == 'considered-internship') {echo "active";}else{ echo "";} ?>" id="liofficers4">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Considered by level 1</p>
                </a>
              </li>
			  @endcan
			   @can('rejected-internship-list')
              <li class="nav-item">
                <a href="{{ url('rejected-internship')}}" class="nav-link <?php if($current_url == 'rejected-internship') {echo "active";}else{ echo "";} ?>">
                   <i class="nav-icon fas fa-user"></i>
                  <p>Rejected Application</p>
                </a>
              </li>
			  @endcan
			   @can('forward-to-committee-internship-list')
			  <li class="nav-item">
                <a href="{{ url('forward-to-committee')}}" class="nav-link <?php if($current_url == 'forward-to-committee') {echo "active";}else{ echo "";} ?>">
                   <i class="nav-icon fas fa-user"></i>
                  <p>Forward to committee</p>
                </a>
              </li>
			  @endcan
			   @can('Selected-internship-list')
			  <li class="nav-item">
                <a href="{{ url('selected-internship')}}" class="nav-link <?php if($current_url == 'selected-internship') {echo "active";}else{ echo "";} ?>">
                   <i class="nav-icon fas fa-user"></i>
                  <p>Selected Candidate</p>
                </a>
              </li>
			  @endcan
			  
             </ul>
          </li>
           @endif
           <!-------------------Scheme Code 1 end---------------------->
		 <?php }else if($menu_id == "3"){?>
		   <!-------------------Scheme Code 3 Start---------------------->
		   @if(Gate::check('admin-nref-institute-list') || Gate::check('considered-nref-institute-by-level1-list') || Gate::check('rejected-nref-institute-list') || Gate::check('forward-to-committee-nref-institute-list') || Gate::check('Selected-nref-institute-list') || Gate::check('nref-pending-student-list') || Gate::check('nref-considered-by-1-student-list') || Gate::check('nref-rejected-student-list') || Gate::check('nref-forward-committee-student-list') || Gate::check('nref-final-selected-student-list') || Gate::check('nref-final-rejected-student-list') || Gate::check('nref-student-attendance')|| Gate::check('finalRejected-nref-institute-list')|| Gate::check('finalselected-nref-institute-list') )
			   
		   
          <li class="nav-item has-treeview"  id="liofficer">
            <a href="#" class="nav-link {{$nrefMClass}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                NREF
                <i class="fas fa-angle-left right"></i>
             </p>
            </a>
            <ul class="nav nav-treeview" id="ulofficer">
			 <li class="nav-item">
                <a href="{{ url('nref-home')}}" class="nav-link  <?php if($current_url == 'nref-home') {echo "active";}else{ echo "";} ?>" id="liofficers1">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Nref Dashboard</p>
                </a>
              </li>
			
			  
			  
		   <li class="nav-item has-treeview"  id="liofficer">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Institute / University
                <i class="fas fa-angle-left right"></i>
             </p>
            </a>
          <ul class="nav nav-treeview" id="ulofficer">
			 @can('admin-nref-institute-list')
			 <li class="nav-item">
                <a href="{{ url('university')}}" class="nav-link  <?php if($current_url == 'university') {echo "active";}else{ echo "";} ?>" id="liofficers1">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Pending Institute</p>
                </a>
              </li>
			  @endcan
			   @can('considered-nref-institute-by-level1-list')
              <li class="nav-item">
                <a href="{{ url('universityCons')}}" class="nav-link  <?php if($current_url == 'universityCons') {echo "active";}else{ echo "";} ?>" id="liofficers2">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Considered by level 1</p>
                </a>
              </li>
			  @endcan
			   @can('rejected-nref-institute-list')
              <li class="nav-item">
                <a href="{{ url('universityNocons')}}" class="nav-link  <?php if($current_url == 'universityNocons') {echo "active";}else{ echo "";} ?>">
                   <i class="nav-icon fas fa-user"></i>
                  <p>Rejected by level 1</p>
                </a>
              </li>
			  @endcan
			   @can('forward-to-committee-nref-institute-list')
			  <li class="nav-item">
                <a href="{{ url('universityConsAdmin')}}" class="nav-link  <?php if($current_url == 'universityConsAdmin') {echo "active";}else{ echo "";} ?>">
                   <i class="nav-icon fas fa-user"></i>
                  <p>Forward to committee</p>
                </a>
              </li>
			  @endcan
			   
             @can('Selected-nref-institute-list')
			  <li class="nav-item">
                <a href="{{ url('universitySelected')}}" class="nav-link  <?php if($current_url == 'universitySelected') {echo "active";}else{ echo "";} ?>">
                   <i class="nav-icon fas fa-user"></i>
                  <p>Committee Recommended</p>
                </a>
              </li>
			  @endcan
			  
			   @can('finalRejected-nref-institute-list')
			  <li class="nav-item">
                <a href="{{ url('universityFinalReject')}}" class="nav-link  <?php if($current_url == 'universityFinalReject') {echo "active";}else{ echo "";} ?>">
                   <i class="nav-icon fas fa-user"></i>
                  <p>Final Rejection Institute</p> 
                </a>
              </li>
			  @endcan
			  
			  @can('finalselected-nref-institute-list')
			  <li class="nav-item">
                <a href="{{ url('universityFinalSelected')}}" class="nav-link  <?php if($current_url == 'universityFinalSelected') {echo "active";}else{ echo "";} ?>">
                   <i class="nav-icon fas fa-user"></i>
                  <p>FInal Selected Institute</p>
                </a>
              </li>
			  @endcan
			  
			 


			  </ul>
          </li>
		  
         @if(Gate::check('nref-pending-student-list') || Gate::check('nref-considered-by-1-student-list') || Gate::check('nref-rejected-student-list') || Gate::check('nref-forward-committee-student-list') || Gate::check('nref-final-selected-student-list') || Gate::check('nref-final-rejected-student-list'))
		  <li class="nav-item has-treeview"  id="liofficer">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Student Application
                <i class="fas fa-angle-left right"></i>
             </p>
            </a>
            <ul class="nav nav-treeview" id="ulofficer">
			  @can('nref-pending-student-list')
			  <li class="nav-item">
				<a href="{{url('get-institute')}}" class="nav-link <?php if($current_url == 'get-institute') {echo "active";}else{ echo "";} ?>" id="listudent">
				  <i class="nav-icon fas fa-circle"></i>
				  <p>
					Pending Student
					<!-- <span class="right badge badge-danger">New</span> -->
				  </p>
				</a>
			  </li>
			  @endcan
			  @can('nref-considered-by-1-student-list')
			   <li class="nav-item">
				<a href="{{url('admin-student-considered')}}" class="nav-link <?php if($current_url == 'admin-student-considered') {echo "active";}else{ echo "";} ?>" id="listudent">
				  <i class="nav-icon fas fa-circle"></i>
				  <p>
					Considered By level 1
					<!-- <span class="right badge badge-danger">New</span> -->
				  </p>
				</a>
			  </li>
			  @endcan
			  @can('nref-rejected-student-list')
			   <li class="nav-item">
				<a href="{{url('admin-student-rejected')}}" class="nav-link <?php if($current_url == 'admin-student-rejected') {echo "active";}else{ echo "";} ?>" id="listudent">
				  <i class="nav-icon fas fa-circle"></i>
				  <p>
					Rejected by level 1
					<!-- <span class="right badge badge-danger">New</span> -->
				  </p>
				</a>
			  </li>
			  @endcan
			  @can('nref-forward-committee-student-list')
			   <li class="nav-item">
				<a href="{{url('admin-student-forward-to-committee')}}" class="nav-link <?php if($current_url == 'admin-student-forward-to-committee') {echo "active";}else{ echo "";} ?>" id="listudent">
				  <i class="nav-icon fas fa-circle"></i>
				  <p>
					Forward To Committee
					<!-- <span class="right badge badge-danger">New</span> -->
				  </p>
				</a>
			  </li>
			  @endcan
			  @can('nref-commitee-recom-student-list')
			   <li class="nav-item">
				<a href="{{url('admin-student-committee-rec')}}" class="nav-link <?php if($current_url == 'admin-student-committee-rec') {echo "active";}else{ echo "";} ?>" id="listudent">
				  <i class="nav-icon fas fa-circle"></i>
				  <p>
					Committee Recommendation
					<!-- <span class="right badge badge-danger">New</span> -->
				  </p>
				</a>
			  </li>
			  @endcan
			  @can('nref-final-rejected-student-list')
			    <li class="nav-item">
				<a href="{{url('admin-student-final-rejected')}}" class="nav-link <?php if($current_url == 'admin-student-final-rejected') {echo "active";}else{ echo "";} ?>" id="listudent">
				  <i class="nav-icon fas fa-circle"></i>
				  <p>
					Final Rejected Student
					<!-- <span class="right badge badge-danger">New</span> -->
				  </p>
				</a>
			  </li>
			  @endcan
			    @can('nref-final-selected-student-list')
			   <li class="nav-item">
				<a href="{{url('admin-student-final-selected')}}" class="nav-link <?php if($current_url == 'admin-student-final-selected') {echo "active";}else{ echo "";} ?>" id="listudent">
				  <i class="nav-icon fas fa-circle"></i>
				  <p>
					Final Selected Student
					<!-- <span class="right badge badge-danger">New</span> -->
				  </p>
				</a>
			  </li>
			  @endcan
			  
			
			  
			</ul>
			
          </li>
		  @endif
		  
		
            @can('nref-student-attendance')
				<li class="nav-item ">
				<a href="{{ url('attendanceAdmin')}}" class="nav-link <?php if($current_url == 'attendanceAdmin') {echo "active";}else{ echo "";} ?>">
				  <i class="nav-icon fas fa-tachometer-alt"></i>
				  <p>
					Student Attendance
				  </p>
				</a>
			  </li> 
		   @endcan
			  
		  @can('nref-acknowledge-admin')
			<li class="nav-item ">
            <a href="{{ url('acknowledgeAdmin')}}" class="nav-link <?php if($current_url == 'acknowledgeAdmin') {echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Acknowledge Slip
              </p>
            </a>
          </li> 
			@endcan
			@can('progress-report-admin')
			<li class="nav-item ">
            <a href="{{ url('progressReport')}}" class="nav-link <?php if($current_url == 'progressReport') {echo "active";}else{ echo "";} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Progress Report
              </p>
            </a>
          </li> 
			  @endcan
          <li class="nav-item">
            <a href="{{url('fund-transfer')}}" class="nav-link <?php if($current_url == 'fund-transfer') {echo "active";}else{ echo "";} ?>" >
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Fund Transfer
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('application-processed')}}" class="nav-link <?php if($current_url == 'application-processed') {echo "active";}else{ echo "";} ?>"  >
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Application Processed
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
		  
		   
             </ul>
          </li>
           @endif
		  
		   <!-------------------Scheme Code 3 end---------------------->
		   
		   <?php }else if($menu_id == "2"){?>
		   <!-------------------Scheme Code 2 Start---------------------->
		    <li class="nav-item has-treeview"  id="liofficer">
            <a href="#" class="nav-link {{$nresMClass}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                NRES
                <i class="fas fa-angle-left right"></i>
             </p>
            </a>
            <ul class="nav nav-treeview" id="ulofficer">
			 <li class="nav-item">
                <a href="{{ url('nres-home')}}" class="nav-link  <?php if($current_url == 'nres-home') {echo "active";}else{ echo "";} ?>" id="liofficers1">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Nres Dashboard</p>
                </a>
              </li>
			 
			  
             </ul>
          </li>
		 
		   <!-------------------Scheme Code 2 end---------------------->
		   
		    <?php }else if($menu_id == "4"){?>
		   <!-------------------Scheme Code 4 Start---------------------->
		    <li class="nav-item has-treeview"  id="liofficer">
            <a href="#" class="nav-link {{$nrestMClass}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                NREST
                <i class="fas fa-angle-left right"></i>
             </p>
            </a>
            <ul class="nav nav-treeview" id="ulofficer">
			 <li class="nav-item">
                <a href="{{ url('nrest-home')}}" class="nav-link  <?php if($current_url == 'nrest-home') {echo "active";}else{ echo "";} ?>" id="liofficers1">
                   <i class="nav-icon fas fa-users"></i>
                  <p>NREST Dashboard</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{ url('nrest-participants')}}" class="nav-link  <?php if($current_url == 'nrest-participants') {echo "active";}else{ echo "";} ?>" id="liofficers1">
                   <i class="nav-icon fas fa-users"></i>
                  <p>Participants</p>
                </a>
              </li>
			 
			  
             </ul>
          </li>
		   <?php } ?>
		   <!-------------------Scheme Code 4 end---------------------->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>