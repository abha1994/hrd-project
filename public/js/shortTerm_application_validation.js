/******Jquery Institute Form Validation*********/

 

$(document).ready(function() {
	/* $("#shortermname").on("change",function() {
	
	var termVal=$(this).val();
	var _token = $('input[name="_token"]').val();
	//alert(_token);
	
	$.ajax({
    type: "post",
    url: 'getProgramAjax', // This is what I have updated
    data: { 'termVal': termVal,_token }
    }).done(function( result ) {
	if(result!=0){
	$("#programnew").html(result);
	return false;
		}
});
	
	
	}); */
});


// MAin Listing Filter Code

$(document).ready(function() {
	$("#filterSearch").click(function() { 

	var getUrl = window.location;
	var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	var folderName= getUrl.pathname.split('/')[1];
	
	//alert(baseurl);

	var shortermname=$("#shortermname").val();
	var stateId= $("#stateId").val();
	var frmDate = $("#datepicker_search_from").val();
	var toDate = $("#dt21").val();
	var institutetype = $("#institutetype").val();
	//var programnew=$("#programnew").val();
	
	
	
	var _token = $('input[name="_token"]').val();
	
	
	    $("#instpdf").val(shortermname);
		$("#statepdf").val(stateId);
		$("#frmdatepdf").val(frmDate);
		$("#todatepdf").val(toDate);
		
	
	/* if(shortermname=="")
	{
		alert("Please Select Short Term");
		$("#shortermname").focus();
		return false;
	} */
	//else {
		
		$('#example').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { shortermname,stateId,frmDate,toDate,institutetype,_token }
                },

                'columns': [
				    { data: 'program' },
                    { data: 'cordinateName' },
					{ data: 'cordinateMobile' },
					{ data: 'action' },
                ]
            });
	
	
	//}

	
	});
});
  
  
  $(document).ready(function() {
	$( "#example" ).DataTable({
		bDestroy: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  
  } );
  



  /******Jquery Institute Form Validation*********/