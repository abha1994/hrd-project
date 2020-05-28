/******Jquery Institute Form Validation*********/

 

$(document).ready(function() {
	$("#shortermname").on("change",function() { 
	
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
	
	
	});
});


// MAin Listing Filter Code

$(document).ready(function() {
	$("#filterSearch").click(function() { 

	var getUrl = window.location;
	var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
	var folderName= getUrl.pathname.split('/')[1];
	
	//alert(baseurl);

	var shortermname=$("#shortermname").val();
	var programnew=$("#programnew").val();
	
	
	
	var _token = $('input[name="_token"]').val();
	
	if(shortermname=="")
	{
		alert("Please Select Short Term");
		$("#shortermname").focus();
		return false;
	}
	else {
		
		$('#atten_table').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':getattandanceTerm,
					'data': { shortermname,programnew,_token }
                },

                'columns': [
				    { data: 'fellowname' },
                    { data: 'stream' },
					{ data: 'clickTocheck' },
                ]
            });
	
	
	}

	
	});
});
  
  
  $(document).ready(function() {
	$( "#atten_table" ).DataTable({
		bDestroy: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } );
  



  /******Jquery Institute Form Validation*********/