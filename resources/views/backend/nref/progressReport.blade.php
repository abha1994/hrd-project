@extends('layouts.master')

@section('container')
<br />

  <script src="{{ asset('public/js/report_validation.js') }}"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Yearly Progress Report</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5 " style="max-width: 102rem; margin-bottom: 28px;">
	     
@include('includes/flashmessage')



	<div class="card-header text-center"><h4 style="color: #2384c6;">Yearly Progress Report</h4>
	</div>
			
			
    	<div class="card-body">
		
		<!-- <div class="col-md-4" style="float:left">
					
					<select class="form-control"name="month" id="month">
					<?php $curMonth=date("n"); $currentYear= date("Y"); 
					$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
					?>
					<?php for($i=1;$i<=$curMonth;$i++) { ?>
					<option value="<?php echo $i; ?>" <?php if($curMonth==$i) { echo 'selected'; }?>><?php echo $monthArray[$i]; ?></option>
					<?php } ?>
					</select>
					</div>
					
					
					
					<div class="col-md-4" style="float:left">

					<select class="form-control" name="year" id="year">
					<option value="<?php echo $currentYear;?>"><?php echo $currentYear;?></option>
					</select>
					</div>-->
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="acknow_slip">
			    
				<thead>
				       <tr>
							<th>Name of the Fellow </th>
							<th>Stream</th>
							<th>Upload</th>
							<th>Click to check</th>
					  </tr>
					  </thead>
					  
					  
					  <tbody>
					  
						<!--<tr>
						<td colspan='5'><center>No data available in table</center></td>
						</tr>-->
					 
					 @foreach($students as $student)
					  <tr>
					  	<td>{{$student->firstname.' '.$student->middlename.' '.$student->lastname}}</td>
					  	<td>{{$student->course}}</td>
						<td>
						<button type="button"  stdID="<?php echo $student->id;?>" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal" class="uploadValue">Upload</button>
						</td>
						<!--<td><?php foreach($candidates as $candi){ ?><a href="<?php echo URL::asset('public/uploads/nref/progress_report/'.$candi->fileSign);?>" target="_blank"><?php  if($student->id==$candi->student_id) {  ?><?php if($candi->isfilesubmit==1) { echo "Click Here"; } } ?></a><?php } ?></td>-->
						
						<td><?php foreach($reports as $candi){ ?><a href="<?php echo URL::asset('public/uploads/nref/progress_report/'.$candi->report_file);?>" target="_blank"><?php  if($student->id==$candi->student_id && $candi->report_type=='yearly') {  ?>Click Here<?php } ?></a><?php } ?></td>
						
					  </tr>
					  @endforeach
					  
					  </tbody>
					 
				</table> 
				</div>
				
				
				<!--   -->
        </div>
		
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload Progress Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('progress-report-post') }}" autocomplete="off" id="report_progress" method="POST" >
			{!! csrf_field() !!}
			
			<input type="hidden" name="student_id" id="Std_id" />
			<input type="hidden" name="inst_log_id" id="inst_log_id" value="{{ Auth::id()}}" />
			<input type="hidden" name="inst_id" value="{{$institute_detailID->institute_id}}" />
			<!--<input type="hidden" name="month" id="mnth_id" />
			<input type="hidden" name="year" id="yr_id" />-->
			
			        <div class="form-group" >
					<label>Progress Report Type</label>
					<select class="form-control" name="report_type">
					<option value="">Select Type</option>
					<option value="quarterly">Quarterly</option>
					<option value="yearly">Yearly</option>
					</select>
					</div>
		
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="fileSign" class="form-control"  />
					</div>
		
		
					<div class="form-group" >
					<input type="submit" name="upload" id="uploadSubmit" class="btn btn-primary " />
					</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div></div>

<script>

/*$(document).ready(function() {
	$( "#acknow_slip" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } ); */

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
	
	