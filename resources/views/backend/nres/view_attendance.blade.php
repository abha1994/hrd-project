@extends('layouts.master')
@section('container')
<br />

	 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb"style="" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Candidate Attendance View</li>
      </ol>
    <div class="card card-login mx-auto mt-5 " style="max-width: 102rem; margin-bottom: 28px;">
	     


	<div class="card-header text-center"><h4 style="color: #2384c6;">Candidate Attendance View <?php //echo "<pre>";print_r($singleRecord); ?></h4></div>
    	<div class="card-body">
    		<!-- @include('includes/flashmessage') -->
			
			<?php $curMonth=date("n"); $currentYear= date("Y"); 
			$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
			
			$currentYear= date("Y");
			
			//echo $monthArray[$curMonth];
			?>
			
			<div class="form-row">
				  <div class="form-group col-md-4">
				     	<label for="month">Month</label>
						<input type="text" class="form-control" value="{{$monthArray[$singleRecord[0]->month_atten]}}" readonly>
				  </div>
				  <div class="form-group col-md-4">
				     	<label for="year">Year </label>				     	 
				     	<input type="text" name="year"  class="form-control" value="{{$singleRecord[0]->year_atten}}" readonly>
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="working_days">Working Days</label>				     	 
<input type="text" name="working_days" id="working_days" class="form-control" value="{{$singleRecord[0]->working_days}}" readonly>
				     	
				  </div>
				 	 
		    </div>

			
		    <div class="form-row">
				  
				  <div class="form-group col-md-4">
				     	<label for="holiday">Holidays</label>				     	 
				     	<input type="text" name="holiday" id="holiday" class="form-control" value="{{$singleRecord[0]->holidays}}" readonly>
				     	
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="present_days">Present Days </label>				     	 
				     	<input type="text" name="present_days" id="present_days" class="form-control" value="{{$singleRecord[0]->present_days}}" readonly>
				     	
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="absent_days">Absent Days</label>				     	 
				     	<input type="text" name="absent_days" id="absent_days" class="form-control" value="{{$singleRecord[0]->absent_days}}" readonly>
				     	
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="leave_approved_days">Leave Approved Days </label>				     	 
				     	<input type="text" name="leave_approval"  id="leave_approval" class="form-control" value="{{$singleRecord[0]->leave_approved_days}}" readonly>
				     	
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="total_days">Total Days </label>				     	 
				     	<input type="text" name="total_days" id="total_days" class="form-control" value="{{$singleRecord[0]->total_days}}" readonly>
				     	
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="remarks">Remarks</label>				     	 
			            <textarea style="height:35px" class="form-control" name="remarks" readonly>{{$singleRecord[0]->remarks}}</textarea>
				   </div>
				 	 
					<center>
						
						<a href="{{url('attendance-solar-form')}}" style="color:white" class="btn btn-info" >Cancel</a>   	
						
				 	</center> 
		    </div>
		    
		    
        </div>
    </div>
</div></div>
<style>
    .BDC_CaptchaIconsDiv{
        margin-left: 241px;
        margin-top: -54px;
	}
	strong{
        color: red;
        font-size: 11px;
    }
	.error{
	    color: red;
	    font-size: 12px;
	}
	.has-error .form-control {
    border-color: #a94442;
}
</style>
<!-- /.container-fluid-->
@endsection
	
	