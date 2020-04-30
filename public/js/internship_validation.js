  /******Jquery Internship Form Validation*********/
$(document).ready(function(){

	$('#internship_form').on('submit', function(event) {
    
	  $( "#pincode" ).rules( "add", {
    	required: true,
        minlength: 6,
        maxlength: 6,
        digits: true
  		 
	});
	$( "#address" ).rules( "add", {
    	required: true,         
        maxlength: 220,
         
  		 
	});
	$( "#sipcode" ).rules( "add", {
			required: true,
	});
	$( "#categories" ).rules( "add", {
			required: true,
	});
	$( "#area_interest" ).rules( "add", {
			required: true,
	});
	$( "#intern_place" ).rules( "add", {
			required: true,
	});
	$( "#desired_month_year" ).rules( "add", {
			required: true,
	});
	$( "#writeup_interest" ).rules( "add", {
			required: true,maxlength:1000,
	});
	$( "#remarks" ).rules( "add", {
			required: true,maxlength:1000,
	});
	$( "#id_proof" ).rules( "add", {
			required: true,
	});
	$( "#file_photo" ).rules( "add", {    	       
        required: true, 
        // extension: 'jpg|jpeg|JPG|JPEG', 
	});
	$( "#file_id_proof" ).rules( "add", {    	       
         required: true, 
         // extension: 'pdf|PDF',
	});
	
	$( "#file_experience" ).rules( "add", {    	       
        required: true, 
        // extension: 'pdf|PDF',
	});
	$( "#father_name" ).rules( "add", {
			required: true,
	});
	$( "#statecd" ).rules( "add", {
			required: true,
	});
	$( "#districtcd" ).rules( "add", {
			required: true,
	});
	$( "#intern_duration" ).rules( "add", {
			required: true,
	});
	
	
	 
		 $( "#organization" ).rules( "add", {
			required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		 });
		  $( "#organization_address" ).rules( "add", {
		        required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		  });
		   $( "#designation" ).rules( "add", {
		        required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		  });
		  $( "#nature_area" ).rules( "add", {
		        required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
		  });
		  $( "#focus_work" ).rules( "add", {
		        required: function(element) {
				return $("input:radio[name='catg']:checked").val() == '2';
			}
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
  
  
    // $('.yearcompletion_input').each(function() {
        // $(this).rules("add", 
            // {
                // required: true,
                // maxlength: 4,
                // digits: true,
                // messages: {
                    // required: "field is required",
                // }
            // });
    // });
    // $('.markspercentage_input').each(function() {
        // $(this).rules("add", 
            // {
                // required: true,
                // maxlength: 3,
                // digits: true,
                // messages: {
                    // required: "field is required",
                // }
            // });
    // });
	
	
  
});
$("#internship_form").validate();

$('input').keypress(function( e ) {
   if (e.which === 32 && !this.value.length)
        e.preventDefault();
});

});


/******Jquery Internship Form Validation*********/
    
	
$(document).ready(function(){
$('#sort').removeClass('sorting');$('#sort').removeClass('sorting_asc');
});



function remove_data(id){
	$('#addr'+id).remove();
}



//----Row addmore education section---->
  $(document).ready(function(){
	 var i = 1;
	  $("#addrow").click(function(){
		  $('#table_append').append("<tr id='addr"+i+"'><td class='text-center serial'>"+ (i+1) +"</td><td class='text-center'><select class='form-control courseid_input' name='course_id["+i+"]' id='course_id"+i+"'><option value=''>Course</option><option value='Diploma level'>Diploma level</option><option value='Graduation - BA / BSc etc.'>Graduation - BA / BSc etc.</option><option value='Graduation - BE / BTech  etc'>Graduation - BE / BTech  etc</option><option value='Junior Research Fellowship (JRF)'>Junior Research Fellowship (JRF)</option><option value='Mphil - equivalent'>Mphil - equivalent</option><option value='P G Diploma'>P G Diploma</option><option value='PhD'>PhD</option><option value='Post Graduation - M Tech etc.'>Post Graduation - M Tech etc.</option><option value='Post Graduation - MA , MSc etc.'>Post Graduation - MA , MSc etc.</option><option value='Post Graduation - MSc in Renewable Energy'>Post Graduation - MSc in Renewable Energy </option><option value=Senior research fellowship (SRF)'>Senior research fellowship (SRF)</option><option value='XIIth level'>XIIth level</option><option value='Xth level'>Xth level</option></select></td><td class='text-center'><input type='text' class='form-control institute_input'  value='' id='institute"+i+"' placeholder='Enter Institute*' maxlength='50'  name='institute["+i+"]'></td><td class='text-center'><input type='text' class='form-control stream_input'    value='' maxlength='50' id='stream"+i+"' placeholder='Enter Stream*' name='stream["+i+"]'></td><td class='text-center'><select class='form-control passstatus_input' name='pass_status["+i+"]'  id='pass_status"+i+"'onchange='pass_status_check("+i+");' ><option value>Select Status*</option><option value='1'>Pursuing</option><option value='2'>Passed</option></select></td><td class='text-center'><input type='text' class='form-control yearcompletion_input '  value='' id='year_completion"+i+"' maxlength='4' placeholder='Year of Passing*' onkeypress='return isNumberKey(event)' name='year_completion["+i+"]'></td><td class='text-center'><input type='text' class='form-control percentage'  value='' maxlength='5' id='marks_percentage"+i+"' placeholder='Percentage*' name='marks_percentage["+i+"]'></td><td class='text-center'><div class='btn btn-remove'><input type='button' id='"+i+"' class='submit_btn' name='removerow' onclick='remove("+i+");' value='Remove' ></div></td></tr>");
	   i++;
		
	});   
  }); 
//----Row addmore education section---->


  //************ Whether you are employed***************//	
      $(document).ready(function() {
       $("#exp").hide("fast");
		 $("#emp_no").click(function() {
	     $("#exp").hide("fast");
	    });
	  
	     $("#emp_yes").click(function() {
	    	 $("#exp").show("fast");
		});
	   });
  //************ Whether you are employed***************//	
 $(document).ready(function() { 

  
     /******Percentage*********/
    jQuery.validator.addMethod("percentage", function(value, element) 
	{ 
		return this.optional(element) || /(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)/.test(value); 
	}, "Please enter a percentage.");
	 /******Percentage*********/		
   

    
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
     //************For Id proof upload***************//

    //************For Experience file upload***************//	 
    $('#file_experience').bind('change', function() {
		var a=(this.files[0].size);
		if(a > 5000000) {
			$('#file_experience').val('');
		   $('#file_experience_error').html('Maximum allowed size for file is "5MB" ');
		   $('#file_experience_error').css('color','red');
		   return false;
		}else{
			 $('#file_experience_error').html('');
		};
		
		var fileExtension = ['pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        	 $('#file_experience_error').html('Only pdf files allowed');
             $('#file_experience_error').css('color','red');  //file_photo_error
             $('#file_experience').val('');
		   return false;
        }


	 });
     //************For Experience file upload***************//	
	 
	 //************For candidate Photo upload***************//	
    $('#file_photo').bind('change', function() {
		alert();
		var a=(this.files[0].size);///alert(a);
		if(a > 100000) {
			$('#file_photo').val('');
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
              $('#file_photo').val('');
		   return false;
        }


	 });
	 //************For candidate photo upload***************//	
});


   //************For disabled year section if candidate pursing***************//	
   function pass_status_check(i){
		var pass_status = $('#pass_status'+i).val();
			if(pass_status == "1" ){
				$( "#year_completion"+i ).attr('readonly', true); 
			}else{
				$( "#year_completion"+i ).attr('readonly', false);
		   }
	}
    //************For disabled year section if candidate pursing***************//		


  //************ Whether you are employed***************//	
    $(document).ready(function() {
       $("#exp").hide("fast");
		 $("#emp_no").click(function() {
	     $("#exp").hide("fast");
	    });
	  
	     $("#emp_yes").click(function() {
	    	 $("#exp").show("fast");
		});
	   });
  //************ Whether you are employed***************//	
  
  //************Show Interested Area in Internship remaining char**************//	

  $(document).ready(function() {
	  var len = 0;
	  var maxchar = 1000;
      $( '#writeup_interest' ).keyup(function(){
	    len = this.value.length
	    if(len > maxchar){
	        return false;
	    }
	    else if (len > 0) {
	        $( "#remainingC" ).html( "Remaining characters: " +( maxchar - len ) );
	    }
	    else {
	        $( "#remainingC" ).html( "Remaining characters: " +( maxchar ) );
	    }
	  })
	});
 //************Show Interested Area in Internship remaining char**************//
 
  //************Show Remarks remaining char**************//
  $(document).ready(function() {
	  var len = 0;
	  var maxchar = 1000;

	  $( '#remarks' ).keyup(function(){
	    len = this.value.length
	    if(len > maxchar){
	        return false;
	    }
	    else if (len > 0) {
	        $( "#remainingCh" ).html( "Remaining characters: " +( maxchar - len ) );
	    }
	    else {
	        $( "#remainingCh" ).html( "Remaining characters: " +( maxchar ) );
	    }
	  })
	});
//************Show Remarks remaining char**************//

//************Remove education section*************//
     function remove(i){

        $('#addr'+i).remove();
            var k = 1;
            $('.serial').each(function(){
               $(this).text(k);
               k++;
            })
    }
 //************Remove education section*************//

//************user click on preview---->
    function preview_display(){
	    $('#internship_form').validate();
        if ($('#internship_form').valid()) // 
        {
            //alert('check if form is valid');
        }
        else 
        {
             //alert('just show validation errors, dont post');// 
        }
    }
  //************ user click on preview-*************//
  
 
