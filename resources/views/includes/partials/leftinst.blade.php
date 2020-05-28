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
	    $institute_status_check = institute_status_check();
	    $current_url =  Request::segment(1);
		$dashboardClass = $institutepMClass = $studentMClass = $bankMClass = $attendanceMClass = $acknowledgeMClass = $statusMclass1  = $progressMclass1 = $studentMClass = $shortMClass = $stuploadcoursesMClass = $stparticipantMClass  = $stbankdetailsMClass  = $stattandenceMClass  = $stuploadrMClass  = $staackrMClass = ' ' ;
		if($current_url == 'home'){
		   $dashboardClass = 'active';
		}
		if($current_url == 'institute'){
		   $institutepMClass = 'active';
		}
		if($current_url == 'student-registration'){
		   $studentMClass = 'active';
		}
		if($current_url == 'bank-details'){
		   $bankMClass = 'active';
		}
		if($current_url == 'attendance'  ){
		   $attendanceMClass = 'active';
		}
		if($current_url == 'acknowledge_slip' ){
		   $acknowledgeMClass = 'active';
		}
		if($current_url == 'institute_status' ){
		   $statusMclass1 = 'active';
		}
		if($current_url == 'yearly_reportProgress' ){
		   $progressMclass1 = 'active';
		}
		if($current_url == 'st-student-registration' ){
		   $studentMClass = 'active';
		}
		if($current_url == 'short-term-program' ){
		   $shortMClass = 'active';
		}
		if($current_url == 'course-content' ){
		   $stuploadcoursesMClass = 'active';
		}
		if($current_url == 'st-student-registration' ){
		   $stparticipantMClass = 'active';
		}
		if($current_url == 'st-bank-details' ){
		   $stbankdetailsMClass  = 'active';
		}
		if($current_url == 'short_termAttandance' ){
		   $stattandenceMClass  = 'active';
		}
		if($current_url == 'report-content' ){
		   $stuploadrMClass  = 'active';
		}
		if($current_url == 'acknowledge_slip' ){
		   $staackrMClass   = 'active';
		}
	?> 
	
<?php $menu_id = Session::get('menu_id'); ?>
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
          <?php if($menu_id == "5"){?>
          <li class="nav-item">
            <a href="{{ URl('institute')}}" class="nav-link {{$institutepMClass}}" id="liuniversity">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Fellowship University Form
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          
         <?php if(!empty($institute_status_check)){
			 if($institute_status_check->status_id == "3"){ ?>		  
          <li class="nav-item">
            <a href="{{ URL('student-registration')}}" class="nav-link {{$studentMClass}}" id="listudent">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Student Form
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
		
		  
		   <li class="nav-item">
            <a href="{{ URL('bank-details')}}" class="nav-link {{$bankMClass}}" id="libank">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Bank Details
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ URL('attendance')}}" class="nav-link {{$attendanceMClass}}" id="liattandence">
              <i class="nav-icon fas fa-circle"></i>
              <p>
               Attendance
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ URL('acknowledge_slip')}}" class="nav-link {{$acknowledgeMClass}}" id="liack">
              <i class="nav-icon fas fa-user"></i>
              Upload Acknowledgement Slip
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="{{ URL('yearly_reportProgress')}}" class="nav-link {{$progressMclass1}}" id="liack">
              <i class="nav-icon fas fa-user"></i>
              Progress Report
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
			 <?php  }} ?>
		  
		  <?php $candidate_id = Auth::user()->id;?>
		   <li class="nav-item">
            <a href="{{ URL('institute_status')}}/<?php echo $candidate_id;?>" class="nav-link {{$statusMclass1}}" id="listatus">
              <i class="nav-icon fas fa-user"></i>
              Check University Status
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
		  
		  
		  
		  <?php }else if($menu_id == "6"){ ?>
		  
		    <li class="nav-item">
            <a href="{{ URl('short-term-program')}}" class="nav-link {{$shortMClass}}" id="liuniversity">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Short Term Program Form
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
			</li>
			
			<li class="nav-item">
            <a href="{{ URl('course-content')}}" class="nav-link {{$stuploadcoursesMClass}}" id="liuniversity">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Upload Course and Practical Content
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
			</li>
			
			<li class="nav-item">
            <a href="{{ URl('st-student-registration')}}" class="nav-link {{$stparticipantMClass}}" id="liuniversity">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Participant Form
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
			</li>
			
			<li class="nav-item">
            <a href="{{ URl('st-bank-details')}}" class="nav-link {{$stbankdetailsMClass}}" id="liuniversity">
              <i class="nav-icon fas fa-th"></i>
              <p>
                 Bank Details
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
			</li>
			
			<li class="nav-item">
            <a href="{{ URl('short_termAttandance')}}" class="nav-link {{$stattandenceMClass}}" id="liuniversity">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Short Term Attandance
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
			</li>
			
			<li class="nav-item">
            <a href="{{ URl('acknowledge_shortTerm')}}" class="nav-link {{$studentMClass}}" id="">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Short Term Acknowledgement Slip
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
			</li>
						
			<li class="nav-item">
            <a href="{{ URl('report-content')}}" class="nav-link {{$stuploadrMClass}}" id="liuniversity">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Upload Report
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
			</li>
			
		  <?php } ?>
           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>