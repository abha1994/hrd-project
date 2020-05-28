/******Jquery Institute Form Validation*********/

/* on month Chnage	display Data */

$(document).ready(function() { 


$(".commoanPara").change(function(){
	
var monVal=$("#month_attenAdmin").val();
var uni1=$("#university_atten").val();
var yrVal=$("#year_atten").val();
	
var _token = $('input[name="_token"]').val();
	$('#attend').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':pageurl,
					'data': { monVal,uni1,yrVal,_token }
                },

                'columns': [
				    { data: 'fellowname' },
                    { data: 'stream' },
					{ data: 'working' },
					{ data: 'holiday' },
					{ data: 'present' },
					{ data: 'absent' },
					{ data: 'leave' },
					{ data: 'total' },
					{ data: 'remark' },
                ]
            });

	
});




});

$(document).ready(function() {
	$( "#attend" ).DataTable({
		bProcessing: true,
		bRetrieve: true,
		bSort: false,
        bLengthChange: false,

	});
  } );

/* On Month Change Display Data */

  /******Jquery Institute Form Validation*********/