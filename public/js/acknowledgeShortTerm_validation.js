/******Jquery Institute Form Validation*********/
    
 $(document).ready(function() { 
   $('#acknowledge_shortTerm').validate({
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
	 
	}); 


$(document).ready(function() {
$("#filterReport").click(function(){
	
	var getUrl = window.location;
//var baseurl = getUrl.origin;
//var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
var folderName= getUrl.pathname.split('/')[1];
	
	var v1= $('#programnew').val();
	
var _token = $('input[name="_token"]').val();
	$('#acknowldge_short').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { v1,_token }
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
	$( "#acknowldge_short" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } );

 
$(document).on('click', ".uploadValue", function(){
	
var curVal= $(this).attr('stdID');

var candID = $(this).attr('candidate_attn_id');
	
$("#Std_id").val(curVal);
$("#candidate_attn_id").val(candID);

});  
  
  



  /******Jquery Institute Form Validation*********/