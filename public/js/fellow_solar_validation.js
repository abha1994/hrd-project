/******Jquery Fllowship Solar Form Validation*********/
    
 
$(document).ready(function(){
  $('#felloship_solar_form').validate({
	
      ignore: [],
     debug: false,
     rules: {
        ar_spc: {
             required: true,
			 maxlength:1000,
         },
         special_achievement: {
             required: true,
			 maxlength:1000,
         },
         details_awards: {
             required: true,
			 maxlength:1000,
         },
		 book_published: {
            required: true,
			 maxlength:1000,
         },
		 audio_video: {
             required: true,
			 maxlength:1000,
		 },
        details_scholar: {
             required: true,
			 maxlength:1000,
			 
         },
		 paper_published:{
			    required: true,
			 maxlength:1000,
		 },
		why_selected:{
			   required: true,
			 maxlength:1000,
		 },
		 address:{
			   required: true,
			 maxlength:1000,
		 },
		 employed_addr:{
			required: function(element) {
				return $("input:radio[name='employed']:checked").val() == '1';
			}
		 },

		 salary:{
			required: function(element) {
				return $("input:radio[name='employed']:checked").val() == '1';
			}
		 },

		 employed_inst:{
			required: function(element) {
				return $("input:radio[name='employed']:checked").val() == '1';
			}
		 },
		pincode:{
			  required: true,
			  maxlength:6,
			  minlength:6,
		},
		file_photo:{
		   required: true,  
		},
		research_work:{
		    required: true,   
		},
		 file_id_proof:{
			  required: true,  
		 },

		 id_proof: {
		 	  required: true,
		 },

         "reference_three[0]":{
			  phoneStartingWith6: true,  
		 },

		 "reference_three[1]":{
			  phoneStartingWith6: true,  
		 },

		 "reference_three[2]":{
			  phoneStartingWith6: true,  
		 },

		 "reference_three[2]":{
			  phoneStartingWith6: true,  
		 },
		 
		 'reference_two[0]':{
	       email:true,
		 },
		 'reference_two[1]':{
	       email:true,
		 },

		 'reference_two[2]':{
	       email:true,
		 },

		  'reference_two[3]':{
	       email:true,
		 },

		  'reference_two[4]':{
	       email:true,
		 },
		                                            //reference_two
       },submitHandler: function(form) {
          form.submit();
        }

	 });
});
/******Jquery Fllowship Solar Form Validation*********/

/******Jquery Fllowship Bank Form Validation*********/
$(document).ready(function(){
 $('#bankdetails_form').validate({
	
     ignore: [],
     debug: false,
     rules: {
        bank_cname: {
             required: true,
         },
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
             pattern:/^[a-zA-z]{5}\d{4}[a-zA-Z]{1}$/,
             maxlength:10, 
			 
         },
          ifsc_code:{
			  required: true,
			//required: function(element) {
				//return $("input:radio[name='rtgs']:checked").val() == 'Y';
			//},
			pattern: /^[A-Za-z]{4}\d{7}$/,
		 },
		 aadhar_no:{
			    required: true,
			    minlength:12,
		 },
		bank_phone:{
			   required: true,
			   minlength:10,
		 },
		bank_mobile:{
			   required: true,
			   minlength:10,
		 },
		
		bank_email:{
		   required: true,
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
	});


//**************************************************************************//



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

