@extends('layouts.master')
@section('container')
<br />

  <script src="{{ asset('public/js/attendance_fellow_validation.js') }}"></script>
	 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb"style="" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Candidate Attendance Form</li>
      </ol>
	  
	  

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5 " style="max-width: 102rem; margin-bottom: 28px;">
	     


	<div class="card-header text-center"><h4 style="color: #2384c6;">Candidate Attendance Form <?php //echo "<pre>";print_r($singleRecord); ?></h4></div>
    	<div class="card-body">
    		<!-- @include('includes/flashmessage') -->
     	<form  enctype="multipart/form-data"  action="{{ route('store') }}" class="" id="studentAttendanceForm" method="POST" onsubmit="return validate(this);">
			{{csrf_field()}}
			
			<?php $curMonth=date("n"); $currentYear= date("Y"); 
			$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
			
			$currentYear= date("Y");
			
			//echo $monthArray[$curMonth];
			?>
			<input type="hidden" value="<?php echo $currentMonthDays=date('t'); ?>"  name="maxDays" id="maxDays" />
			
			<div class="form-row">
				  <div class="form-group col-md-4">
				     	<label for="month">Month</label>				     	 
				     	<input type="hidden" name="month"  class="form-control" value="{{$curMonth}}">
						<input type="text" class="form-control" value="{{$monthArray[$curMonth]}}" readonly>
				  </div>
				  <div class="form-group col-md-4">
				     	<label for="year">Year </label>				     	 
				     	<input type="text" name="year"  class="form-control" value="{{$currentYear}}" readonly>
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="working_days">Working Days <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="working_days" id="working_days" class="form-control" value="{{old('working_days')}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min="0" maxlength="2">
				     	@if ($errors->has('working_days'))
            			<span class="help-block">
                			<strong>{{ $errors->first('working_days') }}</strong>
             			</span>
        				@endif
				  </div>
				 	 
		    </div>

			
		    <div class="form-row">
				  
				  <div class="form-group col-md-4">
				     	<label for="holiday">Holidays <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="holiday" id="holiday" class="form-control" value="{{old('holiday')}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min="0" maxlength="2">
				     	@if ($errors->has('holiday'))
            			<span class="help-block">
                			<strong>{{ $errors->first('holiday') }}</strong>
             			</span>
        				@endif
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="present_days">Present Days <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="present_days" id="present_days" class="form-control" value="{{old('present_days')}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min="0" maxlength="2" onkeyup="sum1()">
				     	@if ($errors->has('present_days'))
            			<span class="help-block">
                			<strong>{{ $errors->first('present_days') }}</strong>
             			</span>
        				@endif
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="absent_days">Absent Days</label>				     	 
				     	<input type="text" name="absent_days" id="absent_days" class="form-control" value="{{old('absent_days')}}" readonly>
				     	@if ($errors->has('absent_days'))
            			<span class="help-block">
                			<strong>{{ $errors->first('absent_days') }}</strong>
             			</span>
        				@endif
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="leave_approved_days">Leave Approved Days <span style="color: red">*</span></label>				     	 
				     	<input type="text" name="leave_approval"  id="leave_approval" class="form-control" value="{{old('leave_approved_days')}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min="0" maxlength="2" onkeyup="sum1()">
				     	@if ($errors->has('leave_approved_days'))
            			<span class="help-block">
                			<strong>{{ $errors->first('leave_approved_days') }}</strong>
             			</span>
        				@endif
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="total_days">Total Days </label>				     	 
				     	<input type="text" name="total_days" id="total_days" class="form-control" value="{{old('total_days')}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min="0" maxlength="2" readonly>
				     	@if ($errors->has('total_days'))
            			<span class="help-block">
                			<strong>{{ $errors->first('total_days') }}</strong>
             			</span>
        				@endif
				  </div>
				  
				  <div class="form-group col-md-4">
				     	<label for="remarks">Remarks</label>				     	 
			
						<textarea class="form-control" name="remarks" value="{{old('remarks')}}"></textarea>
				     	@if ($errors->has('remarks'))
            			<span class="help-block">
                			<strong>{{ $errors->first('remarks') }}</strong>
             			</span>
        				@endif
				  </div>
				 	 
		    </div>
		    
		    
		    
				<div class="border-top bg-white card-footer text-muted text-left">
				<br />
				<button type="submit" name="editrole" value="Save" class="btn btn-primary font-weight-normal px-4">Save</button>
			<!-- <a href=" " class="btn btn-outline-secondary font-weight-normal mr-2">Add other students detail </a> -->
		</div>			
	    </form>
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
	
	