/******Jquery Institute Form Validation*********/

$(document).ready(function() {

$("#filterSearch").on('click',function(){
	//alert("Hii");
	
	var getUrl = window.location;
    var folderName= getUrl.pathname.split('/')[1];
	
	var shortermname=$("#shortermname").val();
	var programnew=$("#programnew").val();

	
var _token = $('input[name="_token"]').val();
	$('#acknowshort_slip').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { shortermname,programnew,_token }
                },

                'columns': [
				    { data: 'fellowname' },
					{ data: 'instname' },
                    { data: 'stream' },
					{ data: 'clickTocheck' },
                ]
            });

	
});

/* End New Code Of On change */







});

$(document).ready(function() {
	$( "#acknowshort_slip" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } );


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
  
  



  /******Jquery Institute Form Validation*********/