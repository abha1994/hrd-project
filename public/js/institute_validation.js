
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
		/* apx_stdnt: {
			required: true,
		}, */
		
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
		 
		/* 
		 resrch_phd: {
			 required: true,
			 required: function(element) {
				
				alert("Hii");
				if($("#collab_inst").val()!= 'yes')
				{
					//return $("input.resrch_phd:checked").length < 0;
				} 
				else
				{
				return false;
				} 
			}, 
		}, */
		 exp_energy_course: {
            required: true,  
         },
		 course_run:{
			  required:true,
		 },
		 /* no_seat_course:{
			  required:true,
		 }, */
		 spl_offer:{
			  required:true,
		 },
		 spon_project:{
			  required:true,
		 },
		 fellowship_period:{
			  required:true,
		 },
		 
		 fellowship_period_to:{
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
			if(a > 10485760) {
				$('#annual_report').val('');
			   $('#annual_report_error').html('Maximum allowed size for file is "10MB" ');
			   $('#annual_report_error').css('color','red');
			   return false;
			}else{
				 $('#annual_report_error').html('');
			};
		var fileExtension = ['pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        	 $('#annual_report_error').html('<strong>Only pdf files allowed</strong>');
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
				 $('#file_course_proof_error').html('<strong>Only pdf files allowed</strong>');
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
			 $('#file_prevStudent_proof_error').html('<strong>Only pdf files allowed</strong>');
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
			 $('#file_upload_signature_error').html('<strong>Only pdf files allowed</strong>');
			 $('#file_upload_signature_error').css('color','red');  //file_photo_error
			 $('#file_upload_signature').val('');
		   return false;
		}
			
	 });
	 //************For candidate photo upload***************//	
});



// we used jQuery 'keyup' to trigger the computation as the user type

$(document).ready(function() {
$('.fellow').keyup(function () {
 
    var sum = 0;
    $('.fellow').each(function() {
        sum += Number($(this).val());
    });
    $('#ftotal').val(sum);
     
});


$("#fellowship_period").on("change",function() {

var v1= $(this).val();
var v2=$("#fellowship_period_to").val();

if(v1>v2 && v2!="")
{
	alert("From period should be less than To period");
	$("#fellowship_period").val('');
	$("#fellowship_period").focus();
}


});


$("#fellowship_period_to").on("change",function() {

var v1= $(this).val();
var v2=$("#fellowship_period").val();

if(v1<v2 && v1!="")
{
	alert("To period should be Greater than From period");
	$("#fellowship_period_to").val('');
	$("#fellowship_period_to").focus();
}


});

});


/*function calculate() {
	
	var total=0;
	var mtech = document.getElementById('mtech').value;
	var jrf = document.getElementById('jrf').value;
	var srf = document.getElementById('srf').value;
	var msc = document.getElementById('msc').value;
	var ra = document.getElementById('ra').value;
	var pdf = document.getElementById('pdf').value;
	
	if(!isNaN(mtech))
	{
		total +=parseInt(mtech);
	}
	
	if(!isNaN(jrf))
	{
		total +=parseInt(jrf);
	}


	
	if (!isNaN(total)) {
                document.getElementById('ftotal').value = total;
            }
} */

	



 
  //************Show Remarks remaining char**************//
  $(document).ready(function() {
	  
	
	  $(".colab_inst_yes").hide();
	  
	  
	  $("#collab_inst").on('change',function() { 
	 
	  var v2=$(this).val();
	  //alert(v2);
	  if(v2=="yes")
	  {
		  $(".colab_inst_yes").show();
		  $("#prevstd1").show();
		  $("#collab_institute").prop('required',true);
		  $("input[name='resrch_phd[]']").prop('required',true);
		  
	  }
	  else
	  {
		  $(".colab_inst_yes").hide();
		  $("#prevstd1").hide();
		  $("#collab_institute").prop('required',false);
		  $("input[name='resrch_phd[]']").prop('required',false);
	  }
	  
	  });
	  
	   if($("#collab_inst option:selected").val() == 'yes'){
		$(".colab_inst_yes").show();
		$("#prevstd1").show();
		}
		else
		{
			$(".colab_inst_yes").hide();
			$("#prevstd1").hide();
		}
	
	
	$("#val1d").text('E');
	$("#place_service").change(function() {
   var p1=	$(this).val();

	if(p1=="yes")
	{
		$("#prevstd").show();
		$("#val1d").text('F');
		$("#file_prevStudent_proof").prop('required',true);
		
		
	}
	else
	{
		$("#prevstd").hide();
		$("#val1d").text('E');
		$("#file_prevStudent_proof").prop('required',false);
	}	
	
	});
	
	if($("#place_service option:selected").val() == 'yes'){
		$("#prevstd").show();
		$("#val1d").text('F');
	}
	else
	{
		$("#prevstd").hide();
		$("#val1d").text('E');
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
  
  $(function() {
               $("#course_run").datepicker({ dateFormat: "dd-mm-yy" }).val()
       });
  
  //** DatePicker Function **//
  
    $(document).ready(function(){

	$('#updatebtn').on('click', function(event) {
		
		var cnt=$("#counter").val();

		for(j=0;j<cnt;j++) {
			
		if($("#courseid_"+j).val()=="")
		{
		$("#courseid_"+j).focus();
		alert("Please Select Course Value");
		return false;
		}
		
		if($("#student_"+j).val()=="")
		{
		$("#student_"+j).focus();
		alert("Please Enter Student No");
		return false;
		}
		
		if(j==1)
		{
			if($("#courseid_0").val()==$("#courseid_"+j).val())
			{
				alert("Duplicate Entry for course is not allowed");
				$("#courseid_"+j).focus();
				return false;
			}
		}
		
		if(j==2)
		{
			if($("#courseid_0").val()==$("#courseid_1").val())
			{
				alert("Duplicate Entry for course is not allowed");
				$("#courseid_1").focus();
				return false;
			}
			
			if($("#courseid_0").val()==$("#courseid_"+j).val())
			{
				alert("Duplicate Entry for course is not allowed");
				$("#courseid_"+j).focus();
				return false;
			}
			
			if($("#courseid_1").val()==$("#courseid_"+j).val())
			{
				alert("Duplicate Entry for course is not allowed");
				$("#courseid_"+j).focus();
				return false;
			}
		}
		
		
		}
		
		
		
		/* $('.courseid_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                messages: {
                    required: "Course is required",
                }
            });
    }); */
		
	});
	
	/* $('#submitbtn').on("click",function() {
		
	myfile = $("#annual_report").val();
	var ext = myfile.split('.').pop();
	  if(ext!="pdf") {
		$('#file_data_error').html('Only pdf files allow');
		$('#file_data_error').css('color','red');
		return false;
		}
		
	}); */
	
	});