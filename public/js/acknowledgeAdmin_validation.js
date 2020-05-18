/******Jquery Institute Form Validation*********/
    
 $(document).ready(function() { 
   $('#acknowledge_form').validate({
     ignore: [],
     debug: false,
     rules: {
		fileSign: {
           required: true,
		    extension: 'pdf|PDF',  
         },

		 
      },
          submitHandler: function(form) {
          if(form.submit()!==''){
           }
        }
		

	 }); 
	 
	   $(".uploadValue123").click(function() {
			alert('Hii');
		});
	 
	}); 


$(document).ready(function() {
/* $("#month").change(function(){
	
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
                    'url':page_url,
					'data': { monthVal,yearr,_token }
                },

                'columns': [
				    { data: 'fellowname' },
                    { data: 'stream' },
					{ data: 'clickTocheck' },
                ]
            });

	
}); */


$(".commonChange").change(function(){
	
	var getUrl = window.location;
	
//var baseurl = getUrl.origin;
//var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
var folderName= getUrl.pathname.split('/')[1];
	
	var instVal=$("#inst").val();
	var monthVal=$("#month").val();
	var yearr= $('#year').val();

	
var _token = $('input[name="_token"]').val();
	$('#acknow_slip').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { instVal,monthVal,yearr,_token }
                },

                'columns': [
				    { data: 'fellowname' },
					{ data: 'instname' },
                    { data: 'stream' },
					{ data: 'monthname' },
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
var mon= $('#month').val();
var yr= $('#year').val();
	
$("#Std_id").val(curVal);
$("#mnth_id").val(mon);
$("#yr_id").val(yr);

});  
  
  



  /******Jquery Institute Form Validation*********/