/******Jquery Institute Form Validation*********/
    
 $(document).ready(function() { 
   $('#report_progress').validate({
     ignore: [],
     debug: false,
     rules: {
		fileSign: {
           required: true,
		    extension: 'pdf|PDF',  
         },
		 
		 report_type:
		 {
			 required: true,
		 },
		 
		 report_year:
		 {
			 required: true,
		 },
		 
		report_month: {
		required: function(element) {
				if($("#report_type").val()== 'quarterly')
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


$(document).ready(function() { 




/* on change month Datatable content */

/* $("#month").change(function(){
	
	var monthVal=$(this).val();
	var yearr= $('#year').val();
	
	//alert(monthVal);
	
	$.ajax({
    type: "get",
    url: '/vueAxiosIP/acknowledgeAjax', // This is what I have updated
    data: { 'monthVal': monthVal,'yearr':yearr}
}).done(function( result ) {
    //alert( result );
	$(".ajaxPart").html(result);
});

}); */

/* End Change month Code */


/* Start NEw Code Of On change */

$("#month").change(function(){
	
	var getUrl = window.location;
//var baseurl = getUrl.origin;
//var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
var folderName= getUrl.pathname.split('/')[1];
	
	var monthVal=$(this).val();
	var yearr= $('#year').val();
	
var _token = $('input[name="_token"]').val();
	$('#acknow_slip').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':acknowledgeAjax,
					'data': { monthVal,yearr,_token }
                },

                'columns': [
				    { data: 'fellowname' },
                    { data: 'stream' },
					{ data: 'genAcknow' },
					{ data: 'uploadSlip' },
					{ data: 'clickTocheck' },
                ]
            });

	
});

/* End New Code Of On change */







});

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
//var mon= $('#month').val();
//var yr= $('#year').val();
	
$("#Std_id").val(curVal);
//$("#mnth_id").val(mon);
//$("#yr_id").val(yr);

});  


$(document).on('click', ".newModal", function(){
	
var studentID= $(this).attr('stdudentID');
$("#student_id").val(studentID);

}); 

$(document).ready(function() {
	$("#report_type,#reportTypenew").on("change",function() { 
	
	var repVal=$(this).val();
	//alert(repVal);
	
	if(repVal=="quarterly")
	{
		$("#month_report").show();
		$("#newmnth").show();
		
		
	}
	else
	{
		$("#month_report").hide();
		$("#newmnth").hide();
	}
	
	});
});


$(document).ready(function() {
	$("#reportType").on("change",function() {	
	
	var repVal=$(this).val();
	//alert(repVal);
	
	if(repVal=="quarterly")
	{
		$("#monthReport").show();
	}
	else
	{
		$("#monthReport").hide();
	}
	
	});
});




// GET VIEW REPORT FOR DOWNLOAD

$(document).ready(function() {
	$("#viewReport").click(function() { 
	
	var getUrl = window.location;
	var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	var folderName= getUrl.pathname.split('/')[1];


//alert(baseurl);
	
	var std=$("#student_id").val();
	var reportType=$("#reportType").val();
	var reportMonth=$("#reportMonth").val();
	var reportYear=$("#reportYear").val();
	
	if(reportType=="quarterly")
	{
		
	if(reportMonth=="")
	{
	alert("Please select Month");
	$("#reportMonth").focus();
	return false;
	}
	
	if(reportYear=="")
	{
	alert("Please select Year");
	$("#reportYear").focus();
	return false;
	}
	
	}
	
	if(reportType=="yearly")
	{
		
	$("#reportMonth").val('');
	
	if(reportYear=="")
	{
	alert("Please select Year");
	$("#reportYear").focus();
	return false;
	}
	
	}
	
	if(reportType=="")
	{
		
	alert("Please select Report Type");
	$("#reportType").focus();
	return false;
	
	}
	
	else
	{
		$.ajax({
    type: "get",
    url: getReportAjax, // This is what I have updated
    data: { 'std': std,'reportType':reportType,'reportMonth':reportMonth,'reportYear':reportYear }
    }).done(function( result ) {
		
		//alert(result);
		
		if(result!=0){
	$(".ajaxReportFile").html('<a href="' + baseurl +'/public/uploads/nref/progress_report/'+result+'" download>Download</a>');
	return false;
		}
		else{
			$(".ajaxReportFile").html("<p>There is no Report uploaded !!</p>");
			return false;
			
		}
});
		
	

	}
	
	
	

	
	});
});


// MAin Listing Filter Code

$(document).ready(function() {
	$("#filterReport").click(function() { 

	var getUrl = window.location;
	var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	var folderName= getUrl.pathname.split('/')[1];

	var reportType=$("#reportTypenew").val();
	var reportMonth=$("#monthTypenew").val();
	var reportYear=$("#yearTypenew").val();
	
	var _token = $('input[name="_token"]').val();
	
	if(reportType=="quarterly")
	{
		
	if(reportMonth=="")
	{
	alert("Please select Month");
	$("#monthTypenew").focus();
	return false;
	}
	
	if(reportYear=="")
	{
	alert("Please select Year");
	$("#yearTypenew").focus();
	return false;
	}
	
	}
	
	if(reportType=="yearly")
	{
		
	$("#monthTypenew").val('');
	
	if(reportYear=="")
	{
	alert("Please select Year");
	$("#yearTypenew").focus();
	return false;
	}
	
	}
	
	if(reportType=="")
	{
		
	alert("Please select Report Type");
	$("#reportTypenew").focus();
	return false;
	
	}
	
	else
	{
		
		//alert("Hii");
		
		$('#report_table').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':getReportAjaxnew,
					'data': { reportType,reportYear,reportMonth,_token }
                },

                'columns': [
				    { data: 'fellowname' },
                    { data: 'stream' },
					{ data: 'uploadSlip' },
					{ data: 'clickTocheck' },
                ]
            });
			
		/* $.ajax({
    type: "get",
    url: '/'+folderName+'/getReportAjax', // This is what I have updated
    data: { 'std': std,'reportType':reportType,'reportMonth':reportMonth,'reportYear':reportYear }
    }).done(function( result ) {
		
		//alert(result);
		
		if(result!=0){
	$(".ajaxReportFile").html('<a href="' + baseurl +'/public/uploads/nref/progress_report/'+result+'" download>Download</a>');
	return false;
		}
		else{
			$(".ajaxReportFile").html("<p>There is no Report uploaded !!</p>");
			return false;
			
		}
}); */
		
	

	}
	
	
	

	
	});
});
  
  



  /******Jquery Institute Form Validation*********/