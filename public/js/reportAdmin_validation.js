/******Jquery Institute Form Validation*********/

 

$(document).ready(function() {
	$("#reportTypenew").on("change",function() { 
	
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
		$("#monthTypenew").val('');
	}
	
	});
});


// MAin Listing Filter Code

$(document).ready(function() {
	$("#filterReport").click(function() { 

	var getUrl = window.location;
	var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	var folderName= getUrl.pathname.split('/')[1];

	var inst=$("#inst").val();
	var reportType=$("#reportTypenew").val();
	var reportMonth=$("#monthTypenew").val();
	var reportYear=$("#yearTypenew").val();
	
	var _token = $('input[name="_token"]').val();
	
	if(reportType=="yearly")
	{
		
	$("#monthTypenew").val('');
	
	}
	
	/* if(reportType=="quarterly")
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
	{ */
		
		//alert("Hii");
		
		$('#report_table').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':getReportAdminAjaxnew,
					'data': { inst,reportType,reportYear,reportMonth,_token }
                },

                'columns': [
				    { data: 'fellowname' },
                    { data: 'stream' },
					{ data: 'reportType' },
					{ data: 'monthType' },
					{ data: 'yearType' },
					{ data: 'clickTocheck' },
                ]
            });
		
	

	/* } */
	
	
	

	
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
  



  /******Jquery Institute Form Validation*********/