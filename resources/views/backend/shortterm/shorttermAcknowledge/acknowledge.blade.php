@extends('layouts.master')

@section('container')
<br />

<script>
    var page_url = "{{ url('acknowledgeShortAjax') }}";
</script>

  <script src="{{ asset('public/js/acknowledgeShortTerm_validation.js') }}"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Short Term Acknowledgement Slip</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">Short Term Acknowledgement Slip</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	
			
    	
		<!--div class="col-md-3" style="float:left">
		
					<?php
					$course=explode(',',$short_term_program->name_proposed_training_program);
					if(isset($short_term_program->name_proposed_training_program))
					{
					if(count($course)>0)
					{
					$program=$course;
					}
					} ?>
					
					<select class="form-control"name="programnew" id="programnew">
					<option value="">Select Program</option>
					@foreach($program as $programname)
					<option value="{{$programname}}">{{$programname}}</option>
					@endforeach
					</select>
					</div>
					
					<div class="form-group" >
					<input type="submit" id="filterReport" class="btn btn-primary "  value= "Search" />
					</div-->
					
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="acknowldge_short">
			    
				<thead>
				       <tr>
							<th>Name of the Fellow</th>
							<th>Training Program</th>
							<th>Generate Acknowledgement</th>
							<th>Upload Acknowledgement slip</th>
							<th>Click to check</th>
					  </tr>
					  </thead>
					  
					  <tbody>
					 
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
						<td><a href="{{ route('shortTermpdf',['download'=>'pdf']) }}">Download</a></td>
						<td>
						<button type="button"  candidate_attn_id="<?php echo $student->attendence_id;?>" stdID="<?php echo $student->id;?>" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal" class="uploadValue">Upload</button>
						</td>
						<td><?php foreach($candidates as $candi){ ?><a href="<?php echo URL::asset('public/uploads/shortterm/acknowledge/'.$candi->fileSign);?>" target="_blank"><?php  if($student->id==$candi->student_id) {  ?><?php if($candi->isfilesubmit==1) { echo "Click Here"; } } ?></a><?php } ?></td>
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
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload ShortTerm Acknowledgement Slip</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('acknowledge-shortTerm-post') }}" autocomplete="off" id="acknowledge_shortTerm" method="POST" >
			{!! csrf_field() !!}
			
			<input type="hidden" name="student_id" id="Std_id" />
			<input type="hidden" name="candidate_attn_id" id="candidate_attn_id" />
		
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
	
	