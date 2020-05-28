@extends('layouts.master')

@section('container')



 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Upload Course and Practical Content</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">Upload Course and Practical Content</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	
			
    	
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="">
			    
				<thead>
				       <tr>
					        <th>Sr. No.</th>
							<th>Upload Doc Name</th>
							<th>Upload</th>
					  </tr>
					  </thead>
					  
					  
					  <tbody>
					  
					  <?php   $course_content_doc = $short_term_data->course_content_doc;
							  $padaggogy_doc = $short_term_data->padaggogy_doc;
							  $practical_content_doc = $short_term_data->practical_content_doc;
					  ?>
					 <tr>
					        <th>1</th>
							<th>Course Content here</th>
							<td>
							<?php if($course_content_doc != null){ ?>
							    <a href="<?php echo URL::asset('public/uploads/shortterm/course/'.$course_content_doc);?>" target="_blank">Click Here</a>
							<?php } else{?>
							<button type="button"  stdID="1" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal1" class="uploadValue">Upload</button>
							<?php } ?>
							</td>
					  </tr>
					   <tr>
                            <th>2</th>
							<th>Padaggogy here</th>
							<td>
							<?php if($padaggogy_doc != null){ ?>
							   <a href="<?php echo URL::asset('public/uploads/shortterm/padaggogy/'.$padaggogy_doc);?>" target="_blank">Click Here</a>
							<?php } else{?>
							<button type="button"  stdID="2" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal2" class="uploadValue">Upload</button>
							<?php } ?>
							</td>
					  </tr>
					   <tr>
					        <th>3</th>
							<th>Practical Content here</th>
							<td>
							<?php if($practical_content_doc != null){ ?>
							   <a href="<?php echo URL::asset('public/uploads/shortterm/practical/'.$practical_content_doc);?>" target="_blank">Click Here</a>
							<?php } else{?>
							<button type="button"  stdID="3" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModa3" class="uploadValue">Upload</button>
							<?php } ?>
							</td>
					  </tr>
					 
					  
					  </tbody>
					 
				</table> 
				</div>
				
				
				<!--   -->
        </div>
		
    </div>
</div>


<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog ">
   <div class="modal-content">
      <div class="modal-header">
	    <h4 class="modal-title">Course Content<h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	   <form enctype="multipart/form-data" action="{{ url('store_upload') }}" autocomplete="off" id="" method="POST" >
			{!! csrf_field() !!}
		
		            <input type="hidden" name="doc_id" id="doc_id" value="1"/>
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="course_content_doc" id="course_content_doc_data" class="form-control"  />
					</div>
		            <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
					 <p style="font-size: 16px;" id="course_content_doc_data_error"></p>
		
					<div class="form-group" >
					 <button type="submit" class="btn btn-primary" name="nonconsider">Submit</button>
					</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog ">
   <div class="modal-content">
      <div class="modal-header">
	    <h4 class="modal-title">Padaggogy</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	   <form enctype="multipart/form-data" action="{{ url('store_upload') }}" autocomplete="off" id="" method="POST" >
			{!! csrf_field() !!}
			
		            <input type="hidden" name="doc_id" id="doc_id" value="2"/>
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="padaggogy_doc" id="padaggogy_doc_data" class="form-control"  />
					</div>
		             <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
					 <span  style="font-size: 16px;"id="padaggogy_doc_data_error"> </span>
		
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
</div>

<div id="myModa3" class="modal fade" role="dialog">
  <div class="modal-dialog ">
   <div class="modal-content">
      <div class="modal-header">
	    <h4 class="modal-title">Practical Content</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
	   <form enctype="multipart/form-data" action="{{ url('store_upload') }}" autocomplete="off" id="" method="POST" >
			{!! csrf_field() !!}
			
		            <input type="hidden" name="doc_id" id="doc_id" value="3"/>
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="practical_content_doc" id="practical_content_doc_data" class="form-control"  />
					</div>
		            <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB) <br>
					<p style="font-size: 16px;" id="practical_content_doc_data_error"></p>
		
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
</div>

</div>

<script>

        

  //************ Whether you are employed***************//	
 $(document).ready(function() { 

  
     /******Percentage*********/
    
    
	//************For Id proof upload***************//
    $('#padaggogy_doc_data').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#padaggogy_doc_data').val('');
			   $('#padaggogy_doc_data_error').html('Maximum allowed size for file is "1MB" ');
			   $('#padaggogy_doc_data_error').css('color','red');
			   return false;
			}else{
				 $('#padaggogy_doc_data').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				 $('#padaggogy_doc_data_error').html('Only pdf files allow');
				 $('#padaggogy_doc_data_error').css('color','red');
				 $('#padaggogy_doc_data').html('');
				 return false;
			}else{
				 $('#padaggogy_doc_data').html('');
			}
		
	});                         
     //************For Id proof upload***************//
	 
	     $('#course_content_doc_data').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#course_content_doc_data').val('');
			   $('#course_content_doc_data_error').html('Maximum allowed size for file is "1MB" ');
			   $('#course_content_doc_data_error').css('color','red');
			   return false;
			}else{
				 $('#course_content_doc_data').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				 $('#course_content_doc_data_error').html('Only pdf files allow');
				 $('#course_content_doc_data_error').css('color','red');
			     $('#course_content_doc_data').html('');
				 return false;
			}else{
				 $('#course_content_doc_data').html('');
			}
		
	});     
	 
	      $('#practical_content_doc_data').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
			   $('#practical_content_doc_data').val('');
			   $('#practical_content_doc_data_error').html('Maximum allowed size for file is "1MB" ');
			   $('#practical_content_doc_data_error').css('color','red');
			   return false;
			}else{
				 $('#practical_content_doc_data').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#practical_content_doc_data_error').html('Only pdf files allow');
				$('#practical_content_doc_data_error').css('color','red');
				$('#practical_content_doc_data').val('');
				 return false;
			}
		
	}); 
	 
	 
	 
 });
	 
</script>

<!-- /.container-fluid-->

@endsection
	
	