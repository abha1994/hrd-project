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
		//var workingInput = document.getElementsById('working_days');
		var workingInput = document.getElementById('working_days').value;
		var holidayInput = document.getElementById('holiday').value;
		var presentInput = document.getElementById('present_days').value;
		var absentInput = document.getElementById('absent_days').value;
		var leaveInput = document.getElementById('leave_approval').value;
		
		//for (i=0; i<workingInput.length; i++)
			//{
			 
			 if (workingInput== "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#working_days").focus();
                    $("#working_days").css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#working_days").css("border-color", "");	
				}
				
				if (holidayInput== "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#holiday").focus();
                    $("#holiday").css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#holiday").css("border-color", "");	
				}
				
				
				
				if (presentInput== "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#present_days").focus();
                    $("#present_days").css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#present_days").css("border-color", "");	
				}
				
				
				if (leaveInput== "")
				{
			 	// alert('Please Fill all Year Fields');
					$("#leave_approval").focus();
                    $("#leave_approval").css("border-color", "red");					
			 	 return false;
				}
				else{
					$("#leave_approval").css("border-color", "");	
				}
				
				/* checkValueofEachFields Code Start */
				
				var w1=parseInt($("#working_days").val());
				var h1=parseInt($("#holiday").val());
				var p1=parseInt($("#present_days").val());
				var a1=parseInt($("#absent_days").val());
				var L1=parseInt($("#leave_approval").val());
				var maxDays=parseInt($("#maxDays").val());
				var T1=p1 + a1;
				var total= p1 + L1;
				
				$("#absent_days").val(w1-p1);
				$("#total_days").val(total);
				//alert(T1);
				//alert(maxDays);
				
				if(w1>maxDays)
				{
					alert("Working Days should not be greater Current Month Days");
					$("#working_days").focus();
					$("#working_days").val('');
					$("#working_days").css("border-color", "red");
					return false;
				}
				if(h1>w1)
				{
					alert("Holidays should be less then working days");
					$("#holiday").focus();
					$("#holiday").val('');
					$("#holiday").css("border-color", "red");
					return false;
				}
				
				if(p1>w1)
				{
					alert("Present days should be less then working days");
					$("#present_days").focus();
					$("#present_days").val('');
					$("#present_days").css("border-color", "red");
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
					$("#present_days").focus();
					$("#present_days").val('');
					$("#absent_days").val('');
					$("#present_days").css("border-color", "red");
					$("#absent_days").css("border-color", "red");
					return false;
				}
				
				
				if(L1>a1)
				{
					alert("Leave Approved days should not be greater absent days");
					$("#leave_approval").focus();
					$("#leave_approval").val('');
					$("#leave_approval").css("border-color", "red");
					return false;
				}
				
				/* End CheckValuesOfEachFields Code Ended */
				
				
				/* CheckMOnthlyDaysExist */
				
				/* checkMonthlyDaysExist */
				

			//}
			
	}
	
	/* Sum OF Present Days & Leave Approved Days For Total Days */
	
	
	function sum1() {
		
		
            var txtFirstNo = document.getElementById('present_days').value;
            var txtSecondNo = document.getElementById('leave_approval').value;
			 var working_days = document.getElementById('working_days').value;
            var result = parseInt(txtFirstNo) + parseInt(txtSecondNo);
			
			var absent_days=parseInt(working_days) - parseInt(txtFirstNo);
			//alert(absent_days);
			
			
			
             if (!isNaN(result)) {
                document.getElementById('total_days').value = result;
            }
			
			if (!isNaN(absent_days)) {
                document.getElementById('absent_days').value = absent_days;
            }
			
			else{
				
				if(txtFirstNo!="" && txtSecondNo=="")
				{
					document.getElementById('total_days').value = txtFirstNo;
				}
				
				else
				{
					document.getElementById('total_days').value = txtSecondNo;
				}
			} 

		
        }
		
	
	/* End Sum Code */

/* on month Chnage	display Data */

$(document).ready(function() { 

$("#monthnew").change(function(){
	
	var getUrl = window.location;
//var baseurl = getUrl.origin;
//var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
var folderName= getUrl.pathname.split('/')[1];
	
	var monthVal=$(this).val();
	var yearr= $('#yearnew').val();
	

	$('#std_fellowID').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'get',
                'ajax': {
                    'url':'/'+folderName+'/attendanceStudentAjax',
					'data': { monthVal,yearr }
                },

                'columns': [
				    { data: 'srno' },
                    { data: 'month' },
					{ data: 'workingDays' },
					{ data: 'holidays' },
					{ data: 'presentDays' },
					{ data: 'absentDays' },
					{ data: 'leaveApp' },
					{ data: 'totalDays' },
					{ data: 'remarks' },
					{ data: 'actions' },
                ]
            });

	
});

$( "#std_fellowID" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});

}); 



/* On Month Change Display Data */

  /******Jquery Institute Form Validation*********/