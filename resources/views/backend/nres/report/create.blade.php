@extends('layouts.master')

@section('container')
<br />

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active"> Upload Reports</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">Upload Reports</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	

		   @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif
					<div class="col-md-4" style="float:left">
					</div>
					<br><br>
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="acknow_slip">
			    
				<thead>
				       <tr>
							<th>Upload Reports</th>
							<th>Upload</th>
							<th>Download</th>
							<th>View</th>
					  </tr>
					  </thead>
					  <tbody>
		
					  <tr>
					  	<td>Upload Expenditure Report</td>
						<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myER" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->expenditure_rprt)) { ?>
						<td><a href="{{ URL::route('download-report',[1]) }}">Download</a></td>
	         <td><a href="<?php echo URL::asset('public/uploads/upload/expenditure/'.$data->expenditure_rprt);?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   <td>Not Availabale</td>
					   <td>Not Availabale</td>	
					   <?php }  ?>	
						
					  </tr>

					   <tr>
					  	<td>Submit Your Publication</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#mySP" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->publication_rprt)) { ?>
						<td><a href="{{ URL::route('download-report',[2]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/upload/publication/'.$data->publication_rprt); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   	<td>Not Availabale</td>
					   		<td>Not Availabale</td>
					   <?php }  ?>	
						
						
					  </tr>

					  <tr>
					  	<td>Upload Monthly Continuance Report</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myCR" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->continuance_rprt)) { ?>
						<td><a href="{{ URL::route('download-report',[3]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/upload/continuance/'.$data->continuance_rprt); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   	<td>Not Availabale</td>
					   		<td>Not Availabale</td>
					   <?php }  ?>	
						
						
					  </tr>


					       <tr>
					  	<td>Upload  Submission Contingency details Report</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#mySCR" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->contingency_rprt)) { ?>
						<td><a href="{{ URL::route('download-report',[4]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/upload/contingency/'.$data->contingency_rprt); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   	<td>Not Availabale</td>
					   <td>Not Availabale</td>
					   <?php }  ?>
						
					  </tr>

					     <tr>
					  	<td>Periodic Progress Report</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myPPR" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->periodic_rprt)) { ?>
						<td><a href="{{ URL::route('download-report',[5]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/upload/periodic/'.$data->periodic_rprt); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   <td>Not Availabale</td>
					  <td>Not Availabale</td>
					   <?php }  ?>
					  </tr>		

 <tr>
					  	<td>Submit Scientific Output
</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#mySSO" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->scientific_rprt)) { ?>
						<td><a href="{{ URL::route('download-report',[6]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/upload/scientific/'.$data->scientific_rprt); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   <td>Not Availabale</td>
					  <td>Not Availabale</td>
					   <?php }  ?>
					  </tr>			

         <tr>
					  	<td>Final Report</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myFR" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->final_rprt)) { ?>
						<td><a href="{{ URL::route('download-report',[7]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/upload/finalreport/'.$data->final_rprt); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   <td>Not Availabale</td>
					  <td>Not Availabale</td>
					   <?php }  ?>
					  </tr>		

<tr>
					  	<td>Submit Patent</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myP" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->patent_rprt)) { ?>
						<td><a href="{{ URL::route('download-report',[8]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/upload/patent/'.$data->patent_rprt); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   <td>Not Availabale</td>
					  <td>Not Availabale</td>
					   <?php }  ?>
					  </tr>									  

					  
					  </tbody>
				</table> 
				</div>
        </div>
		
    </div>
</div>


<div id="myER" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload Expenditure Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">

	  <form enctype="multipart/form-data" action="{{ route('upload-report-post') }}" autocomplete="off" id="expenditure_form" method="POST" >
			{!! csrf_field() !!}
		
					<div class="form-group" >
					<label>Upload File</label>
		<input type="file" name="expenditure_rprt" id="expend_rprt" class="form-control"  />
					<p style="font-size: 16px;" id="expend_rprt_error"></p>
					</div>
			
					<div class="form-group" >
					<input type="submit" name="upload" id="uploadSubmit" class="btn btn-primary submit_bt" />
					</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="mySP" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Submit your Publication</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">

	  <form enctype="multipart/form-data" action="{{ route('upload-report-post') }}" autocomplete="off" id="publication_form" method="POST" >
			{!! csrf_field() !!}
		
					<div class="form-group" >
					<label>Upload File</label>
		<input type="file" name="publication_rprt" id="publict_rprt" class="form-control"  />
					<p style="font-size: 16px;" id="publict_rprt_error"></p>
					</div>
			
					<div class="form-group" >
					<input type="submit" name="upload" id="uploadSubmit" class="btn btn-primary submit_bt" />
					</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<div id="myCR" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload Monthly Continuance Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('upload-report-post') }}" autocomplete="off" id="continuance_form" method="POST" >
			{!! csrf_field() !!}
	
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="continuance_rprt" id="continuance_reprt" class="form-control"  />
					<p style="font-size: 16px;" id="continuance_reprt_error"></p>
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
</div>
<div id="mySCR" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload  Submission Contingency details Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('upload-report-post') }}" autocomplete="off" id="contingency_form" method="POST" >
			{!! csrf_field() !!}
			
			
		
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="contingency_rprt" id="conting_detail" class="form-control"  />
					</div>
		 <p style="font-size: 16px;" id="conting_detail_error"></p>
		
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
<div id="myPPR" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Periodic Progress Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('upload-report-post') }}" autocomplete="off" id="periodic_form" method="POST" >
			{!! csrf_field() !!}
			
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="periodic_rprt" id="period_rprt" class="form-control"  />
					 <p style="font-size: 16px;" id="period_rprt_error"></p>
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
</div>

<div id="mySSO" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Submit Scientific Output</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('upload-report-post') }}" autocomplete="off" id="scientific_form" method="POST" >
			{!! csrf_field() !!}
			
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="scientific_rprt" id="scientific_ratio" class="form-control"  />
					 <p style="font-size: 16px;" id="scientific_ratio_error"></p>
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
</div>

<div id="myFR" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Final Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('upload-report-post') }}" autocomplete="off" id="final_rprt" method="POST" >
			{!! csrf_field() !!}
			
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="final_rprt" id="fnal_rprt" class="form-control"  />
					 <p style="font-size: 16px;" id="fnal_rprt_error"></p>
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
</div>

<div id="myP" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Submit Patent</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('upload-report-post') }}" autocomplete="off" id="patent_rprt" method="POST" >
			{!! csrf_field() !!}
			
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="patent_rprt" id="submit_patnt" class="form-control"  />
					 <p style="font-size: 16px;" id="submit_patnt_error"></p>
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
</div>


</div>

<script>
/******Jquery Internship Form Validation*********/
    
  $(document).ready(function() { 
  
  
   $('#expenditure_form').validate({
     ignore: [],
     debug: false,
     rules: {
		expenditure_rprt: {
			required: true,
		},
		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }

	 });

  /******Jquery Internship Form Validation*********/




    $('#publication_form').validate({
     ignore: [],
     debug: false,
     rules: {
		publication_rprt: {
			required: true,
		},
		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }

	 });




    $('#continuance_form').validate({
     ignore: [],
     debug: false,
     rules: {
		continuance_rprt: {
			required: true,
		},
		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }

	 });





   $('#contingency_form').validate({
     ignore: [],
     debug: false,
     rules: {
		contingency_rprt: {
			required: true,
		},
		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }

	 });



  $('#periodic_form').validate({
     ignore: [],
     debug: false,
     rules: {
		periodic_rprt: {
			required: true,
		},
		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }

	 });





  $('#scientific_form').validate({
     ignore: [],
     debug: false,
     rules: {
		scientific_rprt: {
			required: true,
		},
		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }

	 });


 $('#final_rprt').validate({
     ignore: [],
     debug: false,
     rules: {
		final_rprt: {
			required: true,
		},
		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }

	 });


$('#patent_rprt').validate({
     ignore: [],
     debug: false,
     rules: {
		patent_rprt: {
			required: true,
		},
		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }

	 });
}); 
  


  
 
	
  //************ Whether you are employed***************//	
     

        

  //************ Whether you are employed***************//	
 $(document).ready(function() { 

  
     /******Percentage*********/
    
    
	//************For Id proof upload***************//
    $('#expend_rprt').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
			   $('#expend_rprt').val('');
			   $('#expend_rprt_error').html('Maximum allowed size for file is "1MB" ');
			   $('#expend_rprt_error').css('color','red');
			   return false;
			}else{
				 $('#expend_rprt').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#expend_rprt_error').html('Only pdf files allow');
				$('#expend_rprt_error').css('color','red');
				$('#expend_rprt').val('');
				 return false;
			}
		
	});                         
     //************For Id proof upload***************//
	 
	     $('#publict_rprt').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
			   $('#publict_rprt').val('');
			   $('#publict_rprt_error').html('Maximum allowed size for file is "1MB" ');
			   $('#publict_rprt_error').css('color','red');
			   return false;
			}else{
				 $('#publict_rprt').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#publict_rprt_error').html('Only pdf files allow');
				$('#publict_rprt_error').css('color','red');
				$('#publict_rprt').val('');
				 return false;
			}
		
	});     
	 
	      $('#continuance_reprt').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
			   $('#continuance_reprt').val('');
			   $('#continuance_reprt_error').html('Maximum allowed size for file is "1MB" ');
			   $('#continuance_reprt_error').css('color','red');
			   return false;
			}else{
				 $('#practical_content_doc_data').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#continuance_reprt_error').html('Only pdf files allow');
				$('#continuance_reprt_error').css('color','red');
				$('#continuance_reprt').val('');
				 return false;
			}
		
	}); 




   	      $('#conting_detail').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
			   $('#conting_detail').val('');
			   $('#conting_detail_error').html('Maximum allowed size for file is "1MB" ');
			   $('#conting_detail_error').css('color','red');
			   return false;
			}else{
				 $('#util_cert').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#conting_detail_error').html('Only pdf files allow');
				$('#conting_detail_error').css('color','red');
				$('#conting_detail').val('');
				 return false;
			}
		
	}); 


  	      $('#period_rprt').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
			   $('#period_rprt').val('');
			   $('#period_rprt_error').html('Maximum allowed size for file is "1MB" ');
			   $('#period_rprt_error').css('color','red');
			   return false;
			}else{
				 $('#prac_cont').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#period_rprt_error').html('Only pdf files allow');
				$('#period_rprt_error').css('color','red');
				$('#period_rprt').val('');
				 return false;
			}
		
	}); 







     $('#scientific_ratio').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#scientific_ratio').val('');
			   $('#scientific_ratio_error').html('Maximum allowed size for file is "1MB" ');
			   $('#scientific_ratio_error').css('color','red');
			   return false;
			}else{
				 $('#scientific_ratio').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#scientific_ratio_error').html('Only pdf files allow');
				 $('#scientific_ratio_error').css('color','red');
				 $('#scientific_ratio').val('');
				 return false;
			}
		
	}); 



          $('#fnal_rprt').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
			   $('#fnal_rprt').val('');
			   $('#fnal_rprt_error').html('Maximum allowed size for file is "1MB" ');
			   $('#fnal_rprt_error').css('color','red');
			   return false;
			}else{
				 $('#fnal_rprt').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#fnal_rprt_error').html('Only pdf files allow');
				$('#fnal_rprt_error').css('color','red');
				$('#fnal_rprt').val('');
				 return false;
			}
		
	}); 




      $('#submit_patnt').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
			   $('#submit_patnt').val('');
			   $('#submit_patnt_error').html('Maximum allowed size for file is "1MB" ');
			   $('#submit_patnt_error').css('color','red');
			   return false;
			}else{
				 $('#submit_patnt').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#submit_patnt_error').html('Only pdf files allow');
			    $('#submit_patnt_error').css('color','red');
				$('#submit_patnt').val('');
				 return false;
			}
		
	}); 



	 
	 
	 });
	 
	 
	 $(function() {
        $('.modal').on('hidden.bs.modal', function(){
            $(this).find("P").value('');
    });
 });
    
  //************ user click on preview-*************//
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
	
	