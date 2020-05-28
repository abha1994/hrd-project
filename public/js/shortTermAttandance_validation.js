/******Jquery Institute Form Validation*********/
    
 /* $(document).ready(function() { 
   $('#shortTerm_attendance').validate({
     ignore: [],
     debug: false,
     rules: {
		short_term_attandance: {
           required: true,		   
         }, 
		 
		 report_type:
		 {
			 required: true,
		 },
		 
		 frmDate:
		 {
			 required: true,
		 },
		 
		 toDate:
		 {
			 required: true,
		 },

		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
           }
        }
		

	 }); 

	 
	}); */


$(document).ready(function() {
	$( "#acknow_slip" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } );

 
$(document).on('click', ".uploadValue", function(){
	
var curVal= $(this).attr('stdID');	
$("#Std_id").val(curVal);
});  


$(document).on('click', ".newModal", function(){
	
var studentID= $(this).attr('stdudentID');
$("#student_id").val(studentID);

});


// GET VIEW REPORT FOR DOWNLOAD

$(document).ready(function() {
	$("#viewReport").click(function() { 
	
	var getUrl = window.location;
	var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	var folderName= getUrl.pathname.split('/')[1];
	
	var std=$("#student_id").val();
	var course_type=$("#course_type").val();
	
	
	if(course_type=="")
	{
		
	alert("Please select Report Type");
	$("#course_type").focus();
	return false;
	
	}
	
	else
	{
		$.ajax({
    type: "get",
    url: 'getshortTermAttandanceAjax', // This is what I have updated
    data: { 'std': std,'course_type':course_type}
    }).done(function( result ) {
		
		//alert(result);
		
		if(result!=0){
	$(".ajaxReportFile").html('<a href="/public/uploads/shortterm/attadance/'+result+'" download>Download</a>');
	return false;
		}
		else{
			$(".ajaxReportFile").html("<p>There is no Program uploaded !!</p>");
			return false;
			
		}
});
		
	

	}
	
	
	

	
	});
});



$(document).ready(function() {
	$( "#report_table" ).DataTable({
		bDestroy: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  
  } );


// MAin Listing Filter Code

$(document).ready(function() {
	$("#filterReport").click(function() { 

	var getUrl = window.location;
	var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	var folderName= getUrl.pathname.split('/')[1];

	var reportType=$("#reportTypenew").val();
	
	var frmdate=$("#frmDate").val();
	
	var todate=$("#toDate").val();
	
	var _token = $('input[name="_token"]').val();
	
	/* if(reportType=="")
	{
		
	alert("Please select Report Type");
	$("#reportTypenew").focus();
	return false;
	
	} */
	
	//else
	//{
		
		//alert("Hii");
		
		$('#report_table').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':'getAttendanceAjaxnew',
					'data': { reportType,frmdate,todate,_token }
                },

                'columns': [
				    { data: 'fellowname' },
                    { data: 'stream' },
					{ data: 'uploadSlip' },
					{ data: 'clickTocheck' },
                ]
            });
		
	

	//}
	
	
	

	
	});
});

   /* $(document).ready(function() {


$('#short_term_attandance').bind('change', function() {
		    var a=(this.files[0].size);
			if(a > 1000000) {
				$('#short_term_attandance').val('');
			   $('#file_data_error').html('Maximum allowed size for file is "1MB" ');
			   $('#file_data_error').css('color','red');
			   $('#short_term_attandance').focus();
			   return false;
			}else{
				alert("Hii");
				 $('#file_data_error').html('');
			}; 
			
			var fileExtension = ['pdf'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				alert('wrong File');
				$('#file_data_error').html('Only pdf files allow');
				 $('#file_data_error').css('color','red');
				 $('#short_term_attandance').focus();
				 return false;
			}
		
	});	

}); */
  
  



  /******Jquery Institute Form Validation*********/