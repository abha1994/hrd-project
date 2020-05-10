

/*********** disabled back button of brower *************
$(document).ready(function () {
    function disableBack() {window.history.forward()}

    window.onload = disableBack();
    window.onpageshow = function (evt) {if (evt.persisted) disableBack()}
});

/*********** disabled back button of brower *************/

 $(document).ready(function () {
  
	/******Mobile Number Start from 6 to 9*********/
	$.validator.addMethod("phoneStartingWith6", function(value, element) {
		return this.optional(element) || /^[6-9]\d{9}$/.test(value);
	}, "Phone number should start with 6,7,8,9");
    /******Mobile Number Start from 6 to 9*********/
	
	
	/******Accept only alpha*********/
   $(".onlyalpha").keypress(function(event){
	var inputValue = event.charCode;
	  if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
		   event.preventDefault();
	 }
   });
   /******Accept only alpha*********/
   
   
   /******Valid email*********/
    jQuery.validator.addMethod("laxEmail", function(value, element) 
	{ 
		return this.optional(element) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value); 
	}, "Please enter a valid email address.");
	 /******Valid email*********/		
	 
	  /*** Valid Pan number *****/

	 jQuery.validator.addMethod("pan", function(value, element)
		{
			return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
		}, "Please enter a valid PAN Number");
	   /****** Valid Pan Number *****/	
});
   
   
   
   /******Datepicker*********/
	
   // var maxBirthdayDate = new Date();
	// maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear()-20);
	// maxBirthdayDate.setMonth(11,31);
    // $( "#datepicker" ).datepicker({
        // changeMonth: true,
		// changeYear: true,
		// dateFormat: 'yy-mm-dd',
		// maxDate: maxBirthdayDate,
		// yearRange: '1965:'+maxBirthdayDate.getFullYear(),
	// });
	/******Datepicker*********/	
	
	
// Number validation................
	function isNumberKey(evt)//For no to be entered only no on keypress
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=45) return false;
		return true;
	}
// Number validation close................
	
	
	
/******Jquery Registeration Form Validation*********/
$(document).ready(function (){
   $('#registration_form').validate({
	
     ignore: [],
     debug: false,
     rules: {
        category_id: {
             required: true,
			 maxlength:2
         },
        first_name:{
			required: function(element) {
				if($("#category_id").val() == '3')
				{
			   return false;
				}
				else
				{
				return true;
				}
			},
            maxlength:30
		},
         middle_name: {
             maxlength:30
         },
		 last_name: {
            maxlength:30
         },
		 email_id: {
             required: true,
             email:true,
			 laxEmail:true,
		 },
          
		 mobile_no:{
			required: function(element) {
			if($("#category_id").val() == '3')
				{
			   return false;
				}
				else
				{
				return true;
				}
			},
			number: true,
			minlength:10,
            maxlength:10,
			phoneStartingWith6: true
		},
		 
		 dob:{
			required: function(element) {
			if($("#category_id").val() == '3')
				{
			   return false;
				}
				else
				{
				return true;
				}
			}
		},
		 	
	
		pan:{
			required: function(element) {
			if($("#category_id").val() == '3')
				{
			   return true;
				}
				else
				{
				return false;
				}
				
			},
			pan: true
		},
		
		pincode:{
			required: function(element) {
			if($("#category_id").val() == '3')
				{
			    return true;
				}
				else
				{
				return false;
				}
				
			},
			number: true,
			minlength:6,
            maxlength:6
		},
		
		institute_name:{
			required: function(element) {
			if($("#category_id").val() == '3')
				{
			    return true;
				}
				else
				{
				return false;
				}
				
			},
		},
		institute_reg_no:{
			required: function(element) {
			if($("#category_id").val() == '3')
				{
			    return true;
				}
				else
				{
				return false;
				}
				
			},
		},
		institute_addres:{
			required: function(element) {
			if($("#category_id").val() == '3')
				{
			    return true;
				}
				else
				{
				return false;
				}
				
			},
		},
		 gender:{
			required: function(element) {
			 if($("#category_id").val() == '3')
				{
			   return false;
				}
				else
				{
				return true;
				}
				
			}
		},
		state:{
			required:true,
		},
		distric:{
		    required:true,
		},
		 CaptchaCode:{
			 required:true,
		 }
       },submitHandler: function(form) {
          if(form.submit()!==''){
             $(".submit_btn").prop('disabled', true);
             $(".submit_btn").val('Processing ...');
           }
        }

	 });


  /******Jquery Registeration Form Validation*********/
  
  
/******Jquery Login Form Validation*********/

   $('#login_form').validate({
     ignore: [],
     debug: false,
     rules: {
         login: {
             required: true,
			 maxlength:30
         },
         password: {
             required: true,
		 },
		 CaptchaCode:{
			 required:true,
		 }
        },messages:{
			   login : { 
				 required :"<font color='red'>Please Enter Username</font>",
				 maxlength: "<font color='red'>The Username may not be greater than 30 characters.</font>",
			   },
			  password : { 
				 required: "<font color='red'>Please enter your password</font>",
			  },
			  CaptchaCode: "<font color='red'>Please Enter a valid captcha</font>",
		 },
          submitHandler: function(form) {
          if(form.submit()!==''){
             $(".submit_btn").prop('disabled', true);
             $(".submit_btn").val('Processing ...');
           }
        }

	 });
});
   /******Jquery Login Form Validation*********/
   
  /************use for hide district and state***********/
	function hide_state_district(sel)
	{
		var countrycd= sel.value;
		if(countrycd=="99")
		 {
			 $(".statecd").show("fast");
		 }
		 else
		 {
			 $(".statecd").hide("fast");	// $('#statecd').addClass('test3').removeClass('error');
		 } 
	 }
    /************use for hide district and state***********/
	
	
	
   	function check()
	{
		var pass1 = document.getElementById('mobile_no');
		if(mobile_no.value.length!=10){ 
			alert("required 10 digits, match requested format!");
		}
		else{
		  $("#enterotp").show(); 
		}
	}
   
   
  
 
      $(document).ready(function() {
	     $("#yesemail").click(function() {
	     $("#ifemail").show("fast");
	     $("#ifmobile").hide("fast");
	    });
	  
	     $("#yesmobile").click(function() {
	    	 $("#ifmobile").show("fast");
		     $("#ifemail").hide("fast");
	     });
	   });

     
	 
	 
	  
	 /************************Rocky Reegistration Form*********/ 
  $(document).ready(function() {
	
	 $(".govtInst").css("display","none");
     var catId=$("#catIDVal").val();
	 
     if(catId==3)
	 {
		 $(".govtInst").show("fast");
		 $(".remainsFields").hide("fast");
		 $(".countryIDValue").hide();
	 }
	
	else
	{
		
		 $(".govtInst").hide("fast");
		 $(".remainsFields").show("fast");
		 $(".countryIDValue").show();
	}
	
	$("#category_id").change(function(){ 
	   var v1= $(this).val();
	   $('#catIDVal').val(v1);
	   if(v1==3)
	   {
		   $(".govtInst").show("fast");
		   $(".remainsFields").hide("fast");
		   $(".countryIDValue").hide();
	   }
	   else
	   {
		    $(".govtInst").hide("fast");
			$(".remainsFields").show("fast");
			$(".countryIDValue").show();
			
	   } 
	   
	   });
	   
     });
	 /************************Rocky Reegistration Form*********/