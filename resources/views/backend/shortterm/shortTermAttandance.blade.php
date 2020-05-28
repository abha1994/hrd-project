@extends('layouts.master')

@section('container')
<br />

<script>
 var getReportAjaxnew= "{{ url('getReportAjaxnew') }}";
 var getReportAjax= "{{ url('getReportAjax') }}";
 var acknowledgeAjax= "{{ url('acknowledgeAjax') }}";



</script>


  <script src="{{ asset('public/js/shortTermAttandance_validation.js') }}"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Short Term Attandance</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	   <div class="card-header text-center"><h4 class="mt-2">Short Term Attandance</h4></div>
	    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
	   @include('includes/flashmessage')
			
	
		
		<div class="col-md-3" style="float:left">
		
		<?php ///echo "<pre>"; print_r($short_term_program); 
		      $course=explode(',',$short_term_program->name_proposed_training_program);
			  
			  //print_r($course);
			  //echo count($course);
			 // $program=array();
			  if(isset($short_term_program->name_proposed_training_program))
			  {
				  if(count($course)>0)
				  {
				  $program=$course;
				  }
			  }
			  
			 // print_r($program);

		//die; ?>
					
					<select class="form-control"name="reportTypenew" id="reportTypenew">
					<option value="">Select Program</option>
					@foreach($program as $programname)
					<option value="{{$programname}}">{{$programname}}</option>
					@endforeach
					</select>
					</div>
					
					<div class="col-md-3" style="float:left">
					
					
					<input type="text" id="frmDate" name="frmDate" placeholder="From Date" class="date form-control frmDate" />
					
					</div>
					
					<div class="col-md-3" style="float:left">
					
					
					<input type="text" id="toDate" name="toDate" placeholder="To Date" class="date form-control toDate" />
					
					</div>

					
					<div class="form-group" >
					<input type="submit" id="filterReport" class="btn btn-primary "  value= "Search" />
					</div>

		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="report_table">
			    
				<thead>
				       <tr>
							<th>Name of the Fellow </th>
							<th>Training Program</th>
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
					  	<td>
						<?php 
					if(isset($short_term_program->name_proposed_training_program))
			        { 
				echo $short_term_program->name_proposed_training_program;
					}
				    ?>
					</td>
						<td>
						<button type="button"  stdID="<?php echo $student->id;?>" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal" class="uploadValue">Upload</button>
						</td>
						
						<td><?php $i=0;foreach($candidates as $candi){ ?><?php  if($student->id==$candi->student_id) { if($i==0) { ?><a href="#" stdudentID=<?php echo $student->id;?> data-toggle="modal" data-target="#myModalnew" class="newModal">Click Here</a><?php $i++; } } ?><?php } ?></td>
						
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
	  <h4 class="modal-title">Upload Short Term Attandance</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('short-term-attenPost') }}" autocomplete="off" id="shortTerm_attendance" method="POST" >
			{!! csrf_field() !!}
			
			<input type="hidden" name="student_id" id="Std_id" />
			<input type="hidden" name="inst_log_id" id="inst_log_id" value="{{ Auth::id()}}" />
			<input type="hidden" name="inst_id" value="<?php if(isset($short_term_program->short_term_id)){echo $short_term_program->short_term_id; } ?>" />
			
			<input type="hidden" name="scheme_code" id="scheme_code" value="<?php if(isset($short_term_program->scheme_code)){echo $short_term_program->scheme_code; } ?>" />
			
			
			        <div class="form-group" >
					<label>Short Term Program</label>
					<select class="form-control" name="report_type" id="report_type">
					<option value="">Select Program</option>
					@foreach($program as $programname)
					<option value="{{$programname}}">{{$programname}}</option>
					@endforeach
					</select>
					</div>
					
					<div class="form-group" >
					<label>From Date</label>
					<input type="text" id="frmDate1" name="frmDate" placeholder="From Date" class="date form-control frmDate" />
					
					</div>
					
					<div class="form-group" >
					<label>To Date</label>
					<input type="text" id="toDate1" name="toDate" placeholder="To Date" class="date form-control toDate" />
					
					</div>
		
					<div class="form-group" >
					<label>Upload File(File Format accepts: PDF &amp; Maximum Size: 1MB)</label>
					<input type="file" name="short_term_attandance" id="short_term_attandance" class="form-control"  />
					</div>
					<span  style="font-size: 12px;"id="file_data_error"> </span>
		
		
					<div class="form-group" >
					<input type="submit" name="upload" id="uploadSubmit" class="btn btn-primary uploadSubmit" />
					</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- CLICK HERE MODEL CODE START -->

<div id="myModalnew" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Download Short Term Attandance</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
			<input type="hidden" name="student_id" id="student_id" />
			
			        <div class="form-group" >
					<label>Short Term Program</label>
					<select class="form-control" id="course_type">
					<option value="">Select Program</option>
					@foreach($program as $programname)
					<option value="{{$programname}}">{{$programname}}</option>
					@endforeach
					</select>
					</div>
					
					<div class="form-group ajaxReportFile">
					</div>
					
					<div class="form-group" >
					<input type="submit" name="upload" id="viewReport" class="btn btn-primary "  value= "View Attandance" />
					</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- CLICK HERE MODEL CODE ENDED -->


</div>

<script>

/*$(document).ready(function() {
	$( "#acknow_slip" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } ); */
  
  
  if($('#short_term_attandance').val() != '') {            
      $.each($('#short_term_attandance').prop("files"), function(k,v){
          var filename = v['name'];    
          var ext = filename.split('.').pop().toLowerCase();
          if($.inArray(ext, ['pdf','doc','docx']) == -1) {
              alert('Please upload only pdf,doc,docx format files.');
              return false;
          }
      });        
}

</script>

<script>
$(document).ready(function() { 
$(".uploadSubmit").click(function() {
	
	myfile = $("#short_term_attandance").val();
	var ext = myfile.split('.').pop();
	
	var report_type = $("#report_type").val();
	var frmDate1 = $("#frmDate1").val();
	var toDate1 = $("#toDate1").val();
	
	if(report_type=="")
	{
		$("#report_type").focus();
		return false;
	}
	
	else if(frmDate1=="")
	{
		$("#frmDate1").focus();
		return false;
	}
	
	else if(toDate1=="")
	{
		$("#toDate1").focus();
		return false;
	}
	
		else if(ext!="pdf") {
		$('#file_data_error').html('Only pdf files allow');
		$('#file_data_error').css('color','red');
		return false;
		}
		else
		{
			return true;
		}
	
	});
	
});
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
	
	