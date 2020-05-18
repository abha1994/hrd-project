

@extends('layouts.master')

@section('container')

<style>
#table td{
   text-align:left;
   padding-left: 50px;
}

.abc{
  background: rgb(252, 190, 27);
    background: -moz-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
    background: -webkit-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
    background: linear-gradient(to bottom, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
     border-radius: 4px;
  width: 680px;
  height: 80px;
  margin: 20px;
  text-align:center;
}
.abc1{
   background: rgb(255, 86, 65);
    background: -moz-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    background: -webkit-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    background: linear-gradient(to bottom, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#ff5641', endColorstr='#fd3261', GradientType=0);
     border-radius: 4px;
  width: 680px;
  height: 400px;
  margin: 20px;
  text-align:center;
}
.intern{
 
   background: rgb(183,71,247);
    background: -moz-linear-gradient(top, rgba(183,71,247,1) 0%, rgba(108,83,220,1) 100%);
    background: -webkit-linear-gradient(top, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);
    background: linear-gradient(to bottom, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b747f7', endColorstr='#6c53dc',GradientType=0 );
    
    border-radius: 4px;
    text-align:center;
    margin: 20px ;
    height: 80px;
    width: 250px;
}
</style>


<?php  //if($user_credential_data->role  == "4"){ ?>

 <!--div class="content-wrapper" >
    <div class="container-fluid">
    <br>
       <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
		 </li>
      </ol>
	  
	 </div>
</div-->
<?php // }else{ ?>

	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">National Renewable Energy Internship</li>
      </ol>
	  <div class="card card-login mx-auto mt-5 ">     
	   <div class="card-header text-center"><h4 class="mt-2">National Renewable Energy Internship</h4></div>
		  <div class="card-body">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><b>Overview of Internship Data</b></li>
      </ol>
	  
	    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100" style="background-color:#528ccc !important">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5"><?php echo $dashboard_data['internship_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Form Submitted</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5"><?php echo $dashboard_data['considered_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Candidate Considered</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"><?php echo  $dashboard_data['selected_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Candidate Selected</span>
              <span class="float-right">
                <i class="fa fa-users"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5"><?php echo $dashboard_data['nonconsidered_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Candidate Non-considered</span>
              <span class="float-right">
                <i class="fa fa-users"></i>
              </span>
            </a>
          </div>
        </div>
      </div> 
	  
      <!--div class="row">
       <div class="abc">
     
      <h2><b><?php echo $dashboard_data['internship_data'];?></b></h2><h4>Form Submitted</h4>
     </div>
     
      <div class="abc">
    
      <h2><b><?php echo $dashboard_data['considered_data'];?></b></h2><h4>Candidate Considered</h4>
     </div>
      </div>
      <div class="row">
      <div class="abc">
     
      <h2><b><?php echo  $dashboard_data['selected_data'];?></b></h2><h4>Candidate Selected</h4>
     </div>
     <div class="abc">
     <h2><b><?php echo $dashboard_data['nonconsidered_data'];?></b></h2><h4>Candidate Notconsidered</h4>
     
     </div>
     </div-->
      <ol class="breadcrumb">
       
        <li class="breadcrumb-item active"><b>Overview of Internship Candidate on Internship Duration Basis</b></li>
      </ol>
	  
	     <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100" style="background-color:#528ccc !important">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5"><?php echo $dashboard_data['twomonth_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">For 2 Months</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5"><?php echo $dashboard_data['threemonth_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">For 3 Months</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"><?php echo  $dashboard_data['fourmonth_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">For 4 Months</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5"><?php echo $dashboard_data['fivemonth_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">For 5 Months</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
		 <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100" style="background-color:#7b7475!important">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <div class="mr-5"><?php echo $dashboard_data['sixmonth_data'];?></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">For 6 Months</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
	
      </div>
      <!--div class="row">
      <div class="intern">
     
     <h2><b><?php echo $dashboard_data['twomonth_data'];?></b></h2><h4>For 2 Months</h4>
     
     </div>
     
      <div class="intern">
     
     <h2><b><?php echo $dashboard_data['threemonth_data'];?></b></h2><h4>For 3 Months</h4>
     
     </div>
    
     <div class="intern">
     
     <h2><b><?php echo $dashboard_data['fourmonth_data'];?></b></h2><h4>For 4 Months</h4>
     
     </div>
     
      <div class="intern">
     
     <h2><b><?php echo $dashboard_data['fivemonth_data'];?></b></h2><h4>For 5 Months</h4>
     
     </div>
     <div class="intern">
     
     <h2><b><?php echo $dashboard_data['sixmonth_data'];?></b></h2><h4>For 6 Months</h4>
     
     </div>
     </div-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><b>Candidate Details on Education Behalf </b></li>
      </ol>
	  
	    <div class="row">
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100" style="background-color:#27a243!important">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">Passed</div>
            </div>
            <a class="card-footer text-white"  href="#">
               <table id="table">
					<span class="float-left">Graduation - BE / BTech:</span><span class="float-right"><?php echo $dashboard_data['gra_be_btech_pass'];?></span><br>
					<span class="float-left">Graduation - BA / BSc:</span><span class="float-right"><?php echo $dashboard_data['gra_ba_bsc_pass'];?></span><br>
					<span class="float-left">Post Graduation - M Tech:</span><span class="float-right"><?php echo $dashboard_data['pg_mtech_pass'];?></span><br>
					<span class="float-left">Post Graduation - MA , MSc:</span><span class="float-right"><?php echo $dashboard_data['pg_ma_msc_pass'];?></span><br>
					<span class="float-left">Post Graduation - MSc in Renewable Energy:</span><span class="float-right"><?php echo $dashboard_data['pg_mscre_pass'];?></span><br>
					<span class="float-left">P G Diploma:</span><span class="float-right"><?php echo $dashboard_data['pg_diploma_pass'];?></span><br>
					<span class="float-left">Mphil - equivalent:</span><span class="float-right"><?php echo $dashboard_data['mphil_pass'];?></span><br>
					<span class="float-left">PhD:</span><span class="float-right"><?php echo $dashboard_data['phd_pass'];?></span><br>
			   </table>
            </a>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100" style="background-color:#b18c1c!important">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">Pursuing</div>
            </div>
            <a class="card-footer text-white" href="#">
              <table id="table">
				   <span class="float-left">Graduation - BE / BTech:</span><span class="float-right"><?php echo $dashboard_data['gra_be_btech_pur'];?></span><br>
				   <span class="float-left">Graduation - BA / BSc:</span><span class="float-right"><?php echo $dashboard_data['gra_ba_bsc_pur'];?></span><br>
				   <span class="float-left">Post Graduation - M Tech:</span><span class="float-right"><?php echo $dashboard_data['pg_mtech_pur'];?></span><br>
				   <span class="float-left">Post Graduation - MA , MSc:</span><span class="float-right"><?php echo $dashboard_data['pg_ma_msc_pur'];?></span><br>
				   <span class="float-left">Post Graduation - MSc in Renewable Energy:</span><span class="float-right"><?php echo $dashboard_data['pg_mscre_pur'];?></span><br>
				   <span class="float-left">P G Diploma:</span><span class="float-right"><?php echo $dashboard_data['pg_diploma_pur'];?></span><br>
				   <span class="float-left">Mphil - equivalent:</span><span class="float-right"><?php echo $dashboard_data['mphil_pur'];?></span><br>
				   <span class="float-left">PhD:</span><span class="float-right"><?php echo $dashboard_data['phd_pur'];?></span><br>
			   </table>
            </a>
          </div>
        </div>
	
      </div>
	
        <?php // echo "<pre>"; print_r($userdata);?>
     </div>
     </div></div></div>
     
     
<?php //} ?>
    <!-- /.container-fluid-->
@endsection
