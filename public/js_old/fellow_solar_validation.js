$('#submitBtn').click(function () {
	
	//$('#submitBtn').attr('data-target','#testModal2');
	
	$("#felloship_solar").validate();
	
	if ($("#felloship_solar").valid()) {
		
		$('#submitBtn').attr('data-target','#confirm-submit');
	}
	else
	{
		alert("Please Fill all required fields");
		$('#submitBtn').attr('data-target','#');
	}
	

    /* when the button in the form, display the entered values in the modal */
   $('#first_namev').html($('#first_name').val());
    $('#middle_namev').html($('#middle_name').val());
    $('#last_namev').html($('#last_name').val());

    $('#email_idv').html($('#email_id').val());
    $('#dobv').html($('#dob').val());
    if($('#gender').val() == 1){
    	$('#genderv').html('Male');
    }
    if($('#gender').val() == 2){
    	$('#genderv').html('Female');
    }
    if($('#gender').val() == 0){
    	$('#genderv').html('Others');
    }
     
    $('#mobile_nov').html($('#mobile_no').val());

    $('#countrycdv').html($('#countryid').val());
    $('#statecdv').html($('#stateid').val());
    $('#districtcdv').html($('#districtid').val());

    //Education Detail
    $('#c0').html($('#courseid_0').val());
    $('#c1').html($('#courseid_1').val());
    $('#c2').html($('#courseid_2').val());
    $('#c3').html($('#courseid_3').val());
    $('#c4').html($('#courseid_4').val());
    $('#c5').html($('#courseid_5').val());
         
    $('#ins0').html($('#institute_0').val());
    $('#ins1').html($('#institute_1').val());
    $('#ins2').html($('#institute_2').val());
    $('#ins3').html($('#institute_3').val());
    $('#ins4').html($('#institute_4').val());
    $('#ins5').html($('#institute_5').val());
    
    $('#st0').html($('#stream_0').val());
    $('#st1').html($('#stream_1').val());
    $('#st2').html($('#stream_2').val());
    $('#st3').html($('#stream_3').val());
    $('#st4').html($('#stream_4').val());
    $('#st5').html($('#stream_5').val());
     
    $('#pass0').html($('#passstatus_0').val());
    $('#pass1').html($('#passstatus_1').val());
    $('#pass2').html($('#passstatus_2').val());
    $('#pass3').html($('#passstatus_3').val());
    $('#pass4').html($('#passstatus_4').val()); 
    $('#pass5').html($('#passstatus_5').val()); 
     
	$('#yearcomp0').html($('#yearcompletion_0').val());
	$('#yearcomp1').html($('#yearcompletion_1').val());
	$('#yearcomp2').html($('#yearcompletion_2').val());
	$('#yearcomp3').html($('#yearcompletion_3').val());
	$('#yearcomp4').html($('#yearcompletion_4').val());
	$('#yearcomp5').html($('#yearcompletion_5').val());
     
	$('#markspercen0').html($('#markspercentage_0').val());
	$('#markspercen1').html($('#markspercentage_1').val());
	$('#markspercen2').html($('#markspercentage_2').val());
	$('#markspercen3').html($('#markspercentage_3').val());
	$('#markspercen4').html($('#markspercentage_4').val());
	$('#markspercen5').html($('#markspercentage_5').val());
     
   $('#area_spce').html($('#area_spc').val());
   $('#special_ach').html($('#special_achievement').val());
   
   $('#details_award').html($('#details_awards').val());
   $('#book_publish').html($('#book_published').val()); 

   $('#audio_videos').html($('#audio_video').val());
   $('#details_scholars').html($('#details_scholar').val()); 


   $('#commitments').html($('#commitment').val());
   $('#submit_bonds').html($('#submit_bond').val()); 
   
   $('#paper_publish').html($('#paper_published').val());
   $('#why_select').html($('#why_selected').val());  

   $('#id_proofs').html($('#id_proof').val());
   $('#file_id_proofs').html($('#file_id_proof').val());  

   $('#research_works').html($('#research_work').val());
   $('#candidate_photos').html($('#candidate_photo').val());  

   $('#refname0').html($('#refname_0').val());
   $('#refemail0').html($('#refemail_0').val());
   $('#refphone0').html($('#refphone_0').val());

   $('#refname1').html($('#refname_[object HTMLInputElement]').val());
   $('#refemail1').html($('#refemail_[object HTMLInputElement]').val());
   $('#refphone1').html($('#refphone_[object HTMLInputElement]').val()); 

   
});

$(document).ready(function(){
	 $('#felloship_solar').on('submit', function(event) {
        //Add validation rule for dynamically generated name fields
       // alert('hello');
	  	 
    $( "#pincode" ).rules( "add", {
    	required: true,
        minlength: 6,
        maxlength: 6,
        digits: true
  		 
	});
    $( "#landline" ).rules( "add", {
    	 
        minlength: 8,
        maxlength: 8,
        digits: true
  		 
	});


	$( "#address" ).rules( "add", {
    	required: true,         
        maxlength: 220,
         
  		 
	});

	$( "#salary" ).rules( "add", {
    	required: true,         
        maxlength: 6,
        digits: true,    
  		 
	});
	$( "#id_proof" ).rules( "add", {
    	required: true,         
          		 
	});

	 

	 $( "#organization" ).rules( "add", {
    	required: true,         
        maxlength: 220,
         
  		 
	 });
	 
	 $( "#organization_address" ).rules( "add", {
    	required: true,         
        maxlength: 220,
         
  		 
	 });

	$( "#area_spc" ).rules( "add", {
    	required: true,       
        maxlength: 220,
         
  		 
	});
	$( "#special_achievement" ).rules( "add", {   
		required: true, 	       
        maxlength: 220,  		 
	});

	$( "#details_awards" ).rules( "add", {   
		required: true, 	       
        maxlength: 220,  		 
	});

	$( "#book_published" ).rules( "add", {   
		required:true, 	       
        maxlength: 220,  		 
	});

	$( "#audio_video" ).rules( "add", {    
		required:true,	       
        maxlength: 220,  		 
	});
	$( "#details_scholar" ).rules( "add", {    
		required:true,	       
        maxlength: 220,  		 
	});
	$( "#paper_published" ).rules( "add", { 
		required:true,   	       
        maxlength: 999,  		 
	});
	$( "#why_selected" ).rules( "add", {   
		required:true,
        maxlength: 999,  		 
	});
	$( "#employed_inst" ).rules( "add", {    	       
        required: true,  	 
	});

	$( "#file_id_proof" ).rules( "add", {    	       
        required: true, 
        // extension: "pdf" 	 
	});
	
	$( "#research_work" ).rules( "add", {    	       
        required: true, 
        // extension: "pdf" 	 
	});  
	$( "#candidate_photo" ).rules( "add", {    	       
        required: true, 
        // extension: "jpg" 	 
	}); 


    $('.courseid_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                messages: {
                    required: "Course is required",
                }
            });
    });
    //Add validation rule for dynamically generated email fields
    $('.institute_input').each(function() {
    	 
        $(this).rules("add", 
            {
                required: true,
                maxlength: 120, 
                messages: {
                    required: "field is required",
                    
                  }
            });
    });

    $('.stream_input').each(function() {
    	 
        $(this).rules("add", 
            {
                required: true,
                maxlength: 120,

                messages: {
                    required: "field is required",
                    
                  }
            });
    });
    $('.passstatus_input').each(function() {
        $(this).rules("add", 
            {
                required: true,

                messages: {
                    required: "field is required",
                }
            });
    });
    $('.yearcompletion_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                maxlength: 4,
                digits: true,
                messages: {
                    required: "field is required",
                }
            });
    });
    $('.markspercentage_input').each(function() {
        $(this).rules("add", 
            {
                required: true,
                maxlength: 3,
                digits: true,
                messages: {
                    required: "field is required",
                }
            });
    });
    $('.refname_input').each(function() {
        $(this).rules("add", 
            {
                //required: true,
                messages: {
                    required: "field is required",
                }
            });
    });
    $('.refemail_input').each(function() {
        $(this).rules("add", 
            {
                //required: true,
                email: true ,
                messages: {
                    required: "field is required",
                }
            });
    });
    $('.refphone_input').each(function() {
        $(this).rules("add", 
            {
               // required: true,
                 
                digits: true,

                messages: {
                    required: "field is required",
                }
            });
    });
}); 
$("#felloship_solar").validate(); 
});

/******Jquery Fllowship Bank Form Validation*********/
$(document).ready(function(){
 $('#bankdetails_form').validate({
	
     ignore: [],
     debug: false,
     rules: {
		
        
         bank_name: {
             required: true,
         },
         branch_name: {
             required: true,
         },
		 account_number: {
            required: true,
           
         },
		 micr_code: {
             required: true,
             minlength:9,
		 },
         pan: {
             required: true,
             pan: true,
             // maxlength:10, 
			 
         },
          ifsc_code:{
			  required: true,
			  ifsc:true
		 },
		  account_type: {
             required: true,
         },
		  student_id: {
             required: true,
         },
		 // aadhar_no:{
			    // required: true,
			    // minlength:12,
		 // },
		// bank_phone:{
			   // required: true,
			   // minlength:10,
			   // phoneStartingWith6: true
		 // },
		bank_mobile:{
               minlength:10,
			   phoneStartingWith6: true
		 },
		
		bank_email:{
		  // required: true,
		   email:true,  
		},
		
		                                            //reference_two
       },submitHandler: function(form) {

       	     form.submit();

        }

	 });
 });
/******Jquery Fllowship Bank Form Validation*********/
  

 $(document).ready(function() { 




 
  $.validator.addMethod("ifsc", function(value, element) {
    var reg = /^[A-Za-z]{4}[0-9]{6,7}$/;
    if (this.optional(element)) {
      console.log(value);
      console.log(element);
      return true;
    }
    if (value.match(reg)) {
      return true;
    } else {
      return false;
    }
  }, "Please specify a valid IFSC CODE");


// Number validation close................
$(".numericOnly").keypress(function (e) {
    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
});
// Number validation close................

	/******Mobile Number Start from 6 to 9*********/
	$.validator.addMethod("phoneStartingWith6", function(value, element) {
		return this.optional(element) || /^[6-9]\d{9}$/.test(value);
	}, "Phone number should start with 6,7,8,9");
    /******Mobile Number Start from 6 to 9*********/
	
	  /*** Valid Pan number *****/

	 jQuery.validator.addMethod("pan", function(value, element)
		{
			return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
		}, "Please enter a valid PAN Number");
	   /****** Valid Pan Number *****/	
	   


	   
	   $('[data-type="adhaar-number"]').keyup(function() {
		  var value = $(this).val();
		  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
		  $(this).val(value);
		});

		$('[data-type="adhaar-number"]').on("change, blur", function() {
		  var value = $(this).val();
		  var maxLength = $(this).attr("maxLength");
		  if (value.length != maxLength) {
			$(this).addClass("highlight-error");
		  } else {
			$(this).removeClass("highlight-error");
		  }
		});

	   
	
    $('#research_work').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#research_work').val('');
			   $('#research_work_error').html('Maximum allowed size for file is "1MB" ');
			   $('#research_work_error').css('color','red');
			   return false;
			}else{
				 $('#research_work_error').html('');
			};
	   var fileExtension = ['pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#research_work_error').html('Only pdf files allow');
            $('#research_work_error').css('color','red');
            $('#research_work').val('');
             return false;
        }
   });
 

  
});

	
 $(document).ready(function() {
	  var len = 0;
	  var maxchar = 1000;
      $('#why_selected').keyup(function(){
	    len = this.value.length
	    if(len > maxchar){
	        return false;
	    }
	    else if (len > 0) {
	        $( "#remainingK" ).html( "Remaining characters: " +( maxchar - len ) );
	    }
	    else {
	        $( "#remainingK" ).html( "Remaining characters: " +( maxchar ) );
	    }
	  })



//**************************************************************************//

	//************For Id proof upload***************//
    $('#file_id_proof').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#file_id_proof').val('');
			   $('#file_id_proof_error').html('Maximum allowed size for file is "1MB" ');
			   $('#file_id_proof_error').css('color','red');
			   return false;
			}else{
				 $('#file_id_proof_error').html('');
			};
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				$('#file_id_proof_error').html('Only pdf files allow');
				 $('#file_id_proof_error').css('color','red');
				 return false;
			}
		
	});

 //************For candidate Photo upload***************//	
    $('#candidate_photo').bind('change', function() {
		// alert();
		var a=(this.files[0].size);///alert(a);
		if(a > 100000) {
			$('#candidate_photo').val('');
		   $('#file_photo_error').html('Maximum allowed size for file is "100kb" ');
		   $('#file_photo_error').css('color','red');
		   return false;
		}else{
			 $('#file_photo_error').html('');
		};

        var fileExtension = ['jpeg', 'jpg'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        	 $('#file_photo_error').html('Only jpg and jpeg allowed');
             $('#file_photo_error').css('color','red');  //file_photo_error
              $('#candidate_photo').val('');
		   return false;
        }


	 });
	 });
     //************For Id proof upload***************//
	 


    $(document).ready(function() {
	  var len = 0;
	  var maxchar = 1000;
      $('#paper_published').keyup(function(){
	    len = this.value.length
	    if(len > maxchar){
	        return false;
	    }
	    else if (len > 0) {
	        $( "#remainingL" ).html( "Remaining characters: " +( maxchar - len ) );
	    }
	    else {
	        $( "#remainingL" ).html( "Remaining characters: " +( maxchar ) );
	    }
	  })
	});






     function removeLine(i){

        $('#ref'+i).remove();
            var k = 1;
            $('.serial').each(function(){
               $(this).text(k);
               k++;
            })
    }

