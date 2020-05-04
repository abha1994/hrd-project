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
        <li class="breadcrumb-item active">Candidate Attendance Details</li>
      </ol>
	  
    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5 ">
	     
    @include('includes/flashmessage')

	<div class="card-header text-center"><h4 style="color: #2384c6;">Candidate Attendance Details</h4>
     @if(!count($attendanceStudent)>0)
		<span class="pull-right" style="margin-top:-35px">  <a href="{{ route('add_attendance') }}" class="btn btn-primary font-weight-normal mr-1 px-3"><i class="fa fa-plus-square-o mr-1" aria-hidden="true"></i> Add Attendance  </a></span>
	 @endif
	</div>

    	<div class="card-body">
		
		<div class="col-md-4" style="float:left">
					
					<select class="form-control"name="monthnew" id="monthnew">
					<?php $curMonth=date("n"); $currentYear= date("Y"); 
					$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
					?>
					<?php for($i=1;$i<=$curMonth;$i++) { ?>
					<option value="<?php echo $i; ?>" <?php if($curMonth==$i) { echo 'selected'; }?>><?php echo $monthArray[$i]; ?></option>
					<?php } ?>
					</select>
					</div>
					
					<div class="col-md-4" style="float:left">

					<select class="form-control" name="yearnew" id="yearnew">
					<option value="<?php echo $currentYear;?>"><?php echo $currentYear;?></option>
					</select>
					</div>
					<br><br>
				
    		  <table  width="100%"  class="table table-bordered" id="std_fellowID">
			    <thead>
				       <tr>
					        <!--th><input type="checkbox"  id="chk123" class="select_all" value=""></th-->
							<th>S. No.</th>
							<th>Month/Year</th>
							<th>Working Days</th>
							<th>Holidays</th>
							<th>Present Days</th>
							<th>Absent Days</th>
							<th>Leave Approved Days</th>
							<th>Total Days</th>
							<th>Remarks</th>
							<th>Action</th>
							 
					  </tr>
					  </thead>
					  <tbody>
					  <?php //echo "<pre>"; print_r($attendanceStudent); //echo count($attendanceStudent); 
					  $monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
					  ?>
					  @foreach($attendanceStudent as $student)
					  
					  
					  <tr>
					  	<td>{{$loop->iteration}}</td>
					  	<td>{{$monthArray[$student->month_atten]}} {{$student->year_atten}}</td>
					  	<td>{{$student->working_days}}</td>
						<td>{{$student->holidays}}</td>
						<td>{{$student->present_days}}</td>
						<td>{{$student->absent_days}}</td>
						<td>{{$student->leave_approved_days}}</td>
						<td>{{$student->total_days}}</td>
						<td>{{$student->remarks}}</td>
					  	<td> <a href="{{ url('view_attendance/'.$student->attendence_id) }}" target="_blank"> View </a> </td>
					  </tr>
					  @endforeach
				</tbody>
				</table> 
				
				<!--   -->
        </div>     </div>
    </div>
</div>

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
	
	