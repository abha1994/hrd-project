/******Jquery Institute Form Validation*********/

/* on month Chnage	display Data */

$(document).ready(function() { 



$(".commoanPara").on("change",function() {

//alert("Hii");

var getUrl = window.location;
//var baseurl = getUrl.origin;
//var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
var folderName= getUrl.pathname.split('/')[1];

//alert(folderName);

var monVal=$("#month_attenAdmin").val();
var uni1=$("#university_atten").val();
var yrVal=$("#year_atten").val();

$.ajax({
    type: "get",
    url: '/'+folderName+'/attendanceAjaxadmin', // This is what I have updated
    data: { 'monVal': monVal,'yrVal':yrVal,'uni1':uni1}
}).done(function( result ) {
	$(".ajaxPart").html(result);
});
	
});




});

/* On Month Change Display Data */

  /******Jquery Institute Form Validation*********/