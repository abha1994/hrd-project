/******Jquery Institute Form Validation*********/
    
 
   /* $('#attendance_form').validate({
     ignore: [],
     debug: false,
     rules: {
		 
		 'month_atten[]': {
                required: true
            }

		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
             // $(".submit_btn").prop('disabled', true);
             // $(".submit_btn").html('Processing ...');
           }
        }
		

	 }); */
	 
	 function validate(){
		var workingInput = document.getElementsByName('working_days[]');
		var holidayInput = document.getElementsByName('holiday[]');
		var presentInput = document.getElementsByName('present_days[]');
		var absentInput = document.getElementsByName('absent_days[]');
		var leaveInput = document.getElementsByName('leave_approval[]');
		for (i=0; i<workingInput.length; i++)
			{
			 
			 if (workingInput[i].value == "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#working_days"+i).focus();
                    $("#working_days"+i).css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#working_days"+i).css("border-color", "");	
				}
				
				if (holidayInput[i].value == "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#holiday"+i).focus();
                    $("#holiday"+i).css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#holiday"+i).css("border-color", "");	
				}
				
				
				
				if (presentInput[i].value == "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#present_days"+i).focus();
                    $("#present_days"+i).css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#present_days"+i).css("border-color", "");	
				}
				
				if (absentInput[i].value == "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#absent_days"+i).focus();
                    $("#absent_days"+i).css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#absent_days"+i).css("border-color", "");	
				}
				
				
				if (leaveInput[i].value == "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#leave_approval"+i).focus();
                    $("#leave_approval"+i).css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#leave_approval"+i).css("border-color", "");	
				}
				
				/* checkValueofEachFields Code Start */
				
				var w1=parseInt($("#working_days" + i).val());
				var h1=parseInt($("#holiday" + i).val());
				var p1=parseInt($("#present_days" + i).val());
				var a1=parseInt($("#absent_days" + i).val());
				var L1=parseInt($("#leave_approval" + i).val());
				var maxDays=parseInt($("#maxDays").val());
				var T1=p1 + a1;
				var total= p1 + L1;
				
				$("#absent_days" + i).val(w1-p1);
				$("#total_days" + i).val(total);
				//alert(T1);
				//alert(maxDays);
				
				if(w1>maxDays)
				{
					alert("Working Days should not be greater Current Month Days");
					$("#working_days" + i).focus();
					$("#working_days" + i).val('');
					$("#working_days"+i).css("border-color", "red");
					return false;
				}
				if(h1>w1)
				{
					alert("Holidays should be less then working days");
					$("#holiday" + i).focus();
					$("#holiday" + i).val('');
					$("#holiday"+i).css("border-color", "red");
					return false;
				}
				
				if(p1>w1)
				{
					alert("Present days should be less then working days");
					$("#present_days" + i).focus();
					$("#present_days" + i).val('');
					$("#present_days"+i).css("border-color", "red");
					return false;
				}
				
				/* if(a1>w1)
				{
					alert("Absent days should be less then working days");
					$("#absent_days" + i).focus();
					$("#absent_days" + i).val('');
					$("#absent_days"+i).css("border-color", "red");
					return false;
				} */
				
				if(T1!=w1)
				{
					alert("Sum of Present Days and Absent Days should be equal to working days");
					$("#present_days" + i).focus();
					$("#present_days" + i).val('');
					$("#absent_days" + i).val('');
					$("#present_days"+i).css("border-color", "red");
					$("#absent_days"+i).css("border-color", "red");
					return false;
				}
				
				
				if(L1>a1)
				{
					alert("Leave Approved days should not be greater absent days");
					$("#leave_approval" + i).focus();
					$("#leave_approval" + i).val('');
					$("#leave_approval"+i).css("border-color", "red");
					return false;
				}
				
				/* End CheckValuesOfEachFields Code Ended */
				
				
				/* CheckMOnthlyDaysExist */
				
				/* checkMonthlyDaysExist */
				

			}
			
	}
	
	/* Sum OF Present Days & Leave Approved Days For Total Days */
	
	
	var workingInputNew = document.getElementsByName('working_days[]');
	
	function sum() {
		
		for (i=0; i<workingInputNew.length; i++) {
            var txtFirstNo = document.getElementById('present_days' + i).value;
            var txtSecondNo = document.getElementById('leave_approval' + i).value;
			 var working_days = document.getElementById('working_days' + i).value;
            var result = parseInt(txtFirstNo) + parseInt(txtSecondNo);
			
			var absent_days=parseInt(working_days) - parseInt(txtFirstNo);
			//alert(absent_days);
			
			
			
            if (!isNaN(result)) {
                document.getElementById('total_days' + i).value = result;
            }
			
			if (!isNaN(absent_days)) {
                document.getElementById('absent_days' + i).value = absent_days;
            }
			
			else{
				
				if(txtFirstNo!="" && txtSecondNo=="")
				{
					document.getElementById('total_days' + i).value = txtFirstNo;
				}
				
				else
				{
					document.getElementById('total_days' + i).value = txtSecondNo;
				}
			}

		}
        }
		
	
	/* End Sum Code */

/* on month Chnage	display Data */

$(document).ready(function() { 

$("#month_atten").on("change",function() { 

var getUrl = window.location;
//var baseurl = getUrl.origin;
//var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
var folderName= getUrl.pathname.split('/')[1];


var monVal=$(this).val();
var yrVal=$("#year_atten").val();

var currentMonth = (new Date).getMonth() + 1;
var currentYear = (new Date).getFullYear();

if(monVal!=currentMonth)
{
	$(".btnAvail").hide();
	//$(".enabledisable").attr('disabled','disabled');
}
else
{
	$(".btnAvail").show();
	//$(".enabledisable").removeAttr('disabled');
}

$.ajax({
    type: "get",
    url: '/'+folderName+'/attendanceAjax', // This is what I have updated
    data: { 'monVal': monVal,'yrVal':yrVal,'currentMonth':currentMonth }
}).done(function( result ) {
    //alert( result );
	
	$(".ajaxPart").html(result);
});


});
});

/* On Month Change Display Data */

  /******Jquery Institute Form Validation*********/