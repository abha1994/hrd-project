@extends('layouts.master')

@section('container')
<br />

<script>
    var page_url = "{{ url('acknowledgeAjaxAdmin') }}";
</script>

  <script src="{{ asset('public/js/acknowledgeAdmin_validation.js') }}"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Acknowledgement Slip</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">Acknowledgement Slip</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	
			
    	
		<div class="col-md-4" style="float:left">
		
		          <select class="form-control commonChange" name="inst" id="inst">
					
					<option value="">Select Institute</option>
					@if(isset($instituteDetails)) 
					@foreach($instituteDetails as $inst_details)
					<option value="{{$inst_details->institute_id}}">{{$inst_details->institute_name}}</option>
					@endforeach
					@endif
					</select>
					</div>
		
		<div class="col-md-3" style="float:left">
					
					<select class="form-control commonChange" name="month" id="month">
					<?php $curMonth=date("n"); $currentYear= date("Y"); 
					$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
					?>
					<option value="">Select Month</option>
					<?php for($i=1;$i<=$curMonth;$i++) { ?>
					<option value="<?php echo $i; ?>" <?php //if($curMonth==$i) { echo 'selected'; }?>><?php echo $monthArray[$i]; ?></option>
					<?php } ?>
					</select>
					</div>
					
					
					
					<div class="col-md-2" style="float:left">

					<select class="form-control" name="year" id="year">
					<option value="<?php echo $currentYear;?>"><?php echo $currentYear;?></option>
					</select>
					</div>
					<br><br>
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="acknow_slip">
			    
				<thead>
				       <tr>
							<th>Name of the Fellow</th>
							<th>Institute Name</th>
							<th>Stream</th>
							<th>Month / Year</th>
							<th>Click to check</th>
					  </tr>
					  </thead>
					  
					  
					  <tbody>
					  
						<!--<tr>
						<td colspan='5'><center>No data available in table</center></td>
						</tr>-->
					 <?php //echo "<pre>"; print_r($students); ?>
					 @if(isset($students)) @foreach($students as $student)
					  <tr>
					  	<td>{{$student->firstname}}</td>
						<td>@foreach($instituteDetails as $inst_details) @if($inst_details->institute_id==$student->institute_id) {{$inst_details->institute_name }} @endif @endforeach</td>
					  	<td>{{$student->course}}</td>
						<td>{{$monthArray[$student->month_atten]}} - {{$student->year_atten}}</td>
						<td><?php foreach($candidates as $candi){ ?><a href="<?php echo URL::asset('public/uploads/nref/acknow_slip/'.$candi->fileSign);?>" target="_blank"><?php  if($student->id==$candi->student_id) {  ?><?php if($candi->isfilesubmit==1) { echo "Click Here"; } } ?></a><?php } ?></td>
					  </tr>
					  @endforeach
					  @endif
					  
					  </tbody>
					 
				</table> 
				</div>
				
				
				<!--   -->
        </div>
		
    </div>
</div>


</div>

<script>

/*$(document).ready(function() {
	$( "#acknow_slip" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } ); 
  
  */

</script>
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
	
	