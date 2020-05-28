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
					  	<td>Upload Utiltization Certificate</td>
						<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myUC" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->utilization_cetificate_doc)) { ?>
						<td><a href="{{ URL::route('download-content',[1]) }}">Download</a></td>
	         <td><a href="<?php echo URL::asset('public/uploads/shortterm/report/utilize/'.$data->utilization_cetificate_doc);?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   <td>Not Availabale</td>
					   <td>Not Availabale</td>	
					   <?php }  ?>	
						
					  </tr>

                      <tr>
					  	<td>Upload Audited Statement Of Expenditure</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myAE" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->audited_statement_doc)) { ?>
						<td><a href="{{ URL::route('download-content',[2]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/shortterm/report/practical/'.$data->audited_statement_doc); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   	<td>Not Availabale</td>
					   		<td>Not Availabale</td>
					   <?php }  ?>	
						
						
					  </tr>

					       <tr>
					  	<td>Upload the Programme Completion Report</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myCR" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->programme_completion_doc)) { ?>
						<td><a href="{{ URL::route('download-content',[3]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/shortterm/report/program/'.$data->programme_completion_doc); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					   <?php } else {  ?>
					   	<td>Not Availabale</td>
					   <td>Not Availabale</td>
					   <?php }  ?>
						
					  </tr>

					     <tr>
					  	<td>Impact of training</td>
					  	<td>
						<button type="button"  stdID="" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myITR" class="uploadValue">Upload</button>
						</td>
						<?php if(!empty($data->impact_tranning)) { ?>
						<td><a href="{{ URL::route('download-content',[4]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/shortterm/report/training/'.$data->impact_tranning); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
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


<div id="myUC" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Utiltization Certificate</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('utilization-form-post') }}" autocomplete="off" id="utilization_form" method="POST" >
			{!! csrf_field() !!}
		
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="utilization_cetificate_doc" id="util_cert" class="form-control"  />
					<p style="font-size: 16px;" id="util_cert_error"></p>
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

<div id="myAE" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload Audited Statement Of Expenditure</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('audited-form-post') }}" autocomplete="off" id="audited_form" method="POST" >
			{!! csrf_field() !!}
	
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="practical_content_doc" id="prac_cont" class="form-control"  />
					<p style="font-size: 16px;" id="prac_cont_error"></p>
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
<div id="myCR" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload the Programme Completion Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('program-form-post') }}" autocomplete="off" id="program_comp" method="POST" >
			{!! csrf_field() !!}
			
			
		
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="programme_completion_doc" id="prog_comp" class="form-control"  />
					</div>
		 <p style="font-size: 16px;" id="prog_comp_error"></p>
		
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

<div id="myITR" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Impact of training</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ route('training-form-post') }}" autocomplete="off" id="impact_form" method="POST" >
			{!! csrf_field() !!}
			
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="impact_tranning" id="imp_trn" class="form-control"  />
					 <p style="font-size: 16px;" id="imp_trn_error"></p>
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
<script>
/******Jquery Internship Form Validation*********/
    
  $(document).ready(function() { 
  
  
   $('#courseContentForm').validate({
     ignore: [],
     debug: false,
     rules: {
		course_content_doc: {
			required: true,
		},
		padaggogy_doc: {
			required: true,
		},
		practical_content_doc: {
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



 $('#utilization_form').validate({
     ignore: [],
     debug: false,
     rules: {
		utilization_cetificate_doc: {
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






 $('#audited_form').validate({
     ignore: [],
     debug: false,
     rules: {
		practical_content_doc: {
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




    $('#program_comp').validate({
     ignore: [],
     debug: false,
     rules: {
		programme_completion_doc: {
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



    $('#impact_form').validate({
     ignore: [],
     debug: false,
     rules: {
		impact_tranning: {
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
				 return false;
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
				 return false;
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
				 return false;
			}
		
	}); 




   	      $('#util_cert').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#util_cert').val('');
			   $('#util_cert_error').html('Maximum allowed size for file is "1MB" ');
			   $('#util_cert_error').css('color','red');
			   return false;
			}else{
				 $('#util_cert').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#util_cert_error').html('Only pdf files allow');
				 $('#util_cert_error').css('color','red');
				 return false;
			}
		
	}); 


  	      $('#prac_cont').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#prac_cont').val('');
			   $('#prac_cont_error').html('Maximum allowed size for file is "1MB" ');
			   $('#prac_cont_error').css('color','red');
			   return false;
			}else{
				 $('#prac_cont').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#prac_cont_error').html('Only pdf files allow');
				 $('#prac_cont_error').css('color','red');
				 return false;
			}
		
	}); 







     $('#prog_comp').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#prog_comp').val('');
			   $('#prog_comp_error').html('Maximum allowed size for file is "1MB" ');
			   $('#prog_comp_error').css('color','red');
			   return false;
			}else{
				 $('#prog_comp').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#prog_comp_error').html('Only pdf files allow');
				 $('#prog_comp_error').css('color','red');
				 return false;
			}
		
	}); 



          $('#imp_trn').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#imp_trn').val('');
			   $('#imp_trn_error').html('Maximum allowed size for file is "1MB" ');
			   $('#imp_trn_error').css('color','red');
			   return false;
			}else{
				 $('#imp_trn').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#imp_trn_error').html('Only pdf files allow');
				 $('#imp_trn_error').css('color','red');
				 return false;
			}
		
	}); 


	 
	 
	 });

    
  //************ user click on preview-*************//
  </script>

@endsection
	
	