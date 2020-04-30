
  /******Jquery Institute Form Validation*********/
    $(document).ready(function() {
	 $('#institute_form').validate({
     ignore: [],
     debug: false,
     rules: {
		 
		 institute_name: {
			required: true,
		},
		dept_name: {
			required: true,
		},
		
		coordinate_prog: {
			required: true,
		},
		type_of_institute: {
			required: true,
		},
		university_rank: {
			required: true,
		},
		annual_report: {
		required: function(element) {
				if($("#attn_repo").val()== '')
				{
			   return true;
				}
				else
				{
				return false;
				}
			},
			},
		yr_est: {
			required: true,
		},
		apx_stdnt: {
			required: true,
		},
		
		file_course_proof: {
		required: function(element) {
				if($("#fac_det").val()== '')
				{
			   return true;
				}
				else
				{
				return false;
				}
			},
			},
		
		 collab_inst: {
            required: true,  
         },
		 
		 resrch_phd: {
			required: function(element) {
				if($("#collab_inst").val()!= 'yes')
				{
			   return true;
				}
				else
				{
				return false;
				}
			},
		}, 
		 exp_energy_course: {
            required: true,  
         },
		 course_run:{
			  required:true,
		 },
		 no_seat_course:{
			  required:true,
		 },
		 spl_offer:{
			  required:true,
		 },
		 spon_project:{
			  required:true,
		 },
		 certified:{
			  required:true,
		 },
		 
		 file_upload_signature: {
		required: function(element) {
				if($("#final_repo").val()== '')
				{
			   return true;
				}
				else
				{
				return false;
				}
			},
			},

		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
          }
        }
		
 });
});
/******Jquery Institute Form Validation*********/
	

  
  
  /************ preview code start*****************/
  
  
  $(document).ready(function() {
		 $("#prev").click(function() {
			  
	     var dept_name = $("#dept_name").val();
		 alert(dept_name);
		 
		 $.ajax({
                  url: 'preview',
                  method: 'post',
                  data: {
                     name: dept_name
                  },
                  success: function(result){
                     //$('.alert').show();
                     //$('.alert').html(result.success);
                  }
				  });
               });
			   
			   
	    });

  
  /************ preview code ended **********/
 $(document).ready(function() { 

  //************For Id proof upload***************//
    $('#annual_report').bind('change', function() {
		var a=(this.files[0].size);
			if(a > 1000000) {
				$('#annual_report').val('');
			   $('#annual_report_error').html('Maximum allowed size for file is "1MB" ');
			   $('#annual_report_error').css('color','red');
			   return false;
			}else{
				 $('#annual_report_error').html('');
			};
		var fileExtension = ['pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        	 $('#annual_report_error').html('Only pdf files allowed');
             $('#annual_report_error').css('color','red');  //file_photo_error
             $('#annual_report').val('');
		   return false;
        }
    });
	
	
	$('#file_course_proof').bind('change', function() {
		var a=(this.files[0].size);
			if(a > 1000000) {
				$('#file_course_proof').val('');
			   $('#file_course_proof_error').html('Maximum allowed size for file is "1MB" ');
			   $('#file_course_proof_error').css('color','red');
			   return false;
			}else{
				 $('#file_course_proof_error').html('');
			};
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				 $('#file_course_proof_error').html('Only pdf files allowed');
				 $('#file_course_proof_error').css('color','red');  //file_photo_error
				 $('#file_course_proof').val('');
			   return false;
			}
    });
	
	
	
     //************For Id proof upload***************//

    //************For Experience file upload***************//	 
    $('#file_prevStudent_proof').bind('change', function() {
		var a=(this.files[0].size);
		if(a > 1000000) {
			$('#file_prevStudent_proof').val('');
		   $('#file_prevStudent_proof_error').html('Maximum allowed size for file is "1MB" ');
		   $('#file_prevStudent_proof_error').css('color','red');
		   return false;
		}else{
			 $('#file_prevStudent_proof_error').html('');
		};
		
		var fileExtension = ['pdf'];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			 $('#file_prevStudent_proof_error').html('Only pdf files allowed');
			 $('#file_prevStudent_proof_error').css('color','red');  //file_photo_error
			 $('#file_prevStudent_proof').val('');
		   return false;
		}
			
	 });
     //************For Experience file upload***************//	
	 
	 //************For candidate Photo upload***************//	
    $('#file_upload_signature').bind('change', function() {
		var a=(this.files[0].size);///alert(a);
		if(a > 1000000) {
			$('#file_upload_signature').val('');
		   $('#file_upload_signature_error').html('Maximum allowed size for file is "1MB" ');
		   $('#file_upload_signature_error').css('color','red');
		   return false;
		}else{
			 $('#file_upload_signature_error').html('');
		};
		
		var fileExtension = ['pdf'];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			 $('#file_upload_signature_error').html('Only pdf files allowed');
			 $('#file_upload_signature_error').css('color','red');  //file_photo_error
			 $('#file_upload_signature').val('');
		   return false;
		}
			
	 });
	 //************For candidate photo upload***************//	
});

	



 
  //************Show Remarks remaining char**************//
  $(document).ready(function() {
	
	  $(".colab_inst_yes").hide();
	  
	  
	  $("#collab_inst").on('change',function() { 
	 
	  var v2=$(this).val();
	  //alert(v2);
	  if(v2=="yes")
	  {
		  $(".colab_inst_yes").show();
	  }
	  else
	  {
		  $(".colab_inst_yes").hide();
	  }
	  
	  });
	  
	   if($("#collab_inst option:selected").val() == 'yes'){
		$(".colab_inst_yes").show();
		}
		else
		{
			$(".colab_inst_yes").hide();
		}
	
	
	$("#val1d").text('F');
	$("#place_service").change(function() {
   var p1=	$(this).val();

	if(p1=="yes")
	{
		$("#prevstd").show();
		$("#val1d").text('G');
		$("#file_prevStudent_proof").prop('required',true);
	}
	else
	{
		$("#prevstd").hide();
		$("#val1d").text('F');
		$("#file_prevStudent_proof").prop('required',false);
	}	
	
	});
	
	if($("#place_service option:selected").val() == 'yes'){
		$("#prevstd").show();
		$("#val1d").text('G');
	}
	else
	{
		$("#prevstd").hide();
		$("#val1d").text('F');
	}
	
	
	  
	});
//************Show Remarks remaining char**************//



//************user click on preview---->
    function preview_display(){
	    $('#institute_form').validate();
        if ($('#institute_form').valid()) // 
        {
            //alert('check if form is valid');
        }
        else 
        {
             //alert('just show validation errors, dont post');// 
        }
    }
//************ user click on preview-*************//
  
//**** DatePicker Function  ****//
  
  $( function() {
    $( "#course_run" ).datepicker();
  } );
  
  //** DatePicker Function **//