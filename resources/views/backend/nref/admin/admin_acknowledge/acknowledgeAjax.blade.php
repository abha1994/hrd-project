<?php
//echo "<pre>"; print_r($candidates); die;
$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
$data = array();
if(isset($attendanceList)) {
foreach($attendanceList as $attendance)
{
	
	if($attendance->fileSign!="")
	{
		$imgURL='<a href="'.URL::asset("public/uploads/nref/acknow_slip").'/'.$attendance->fileSign.'" target="_blank">Click Here</a>';
	}
	else
	{
		$imgURL='-';
	}
	
	$ss="";
if(isset($instituteDetails))
{
foreach($instituteDetails as $inst_details)  
{ 
if($inst_details->institute_id==$attendance->institute_id)
{ 
$ss=$inst_details->institute_name; 
} 
}
}
$data[] = array(
	
	        "fellowname"=>$attendance->firstname,
			"instname"=>$ss,
    		"stream"=>$attendance->course,
			"monthname"=>$monthArray[$attendance->month_atten]. '-'.$attendance->year_atten,
			"clickTocheck"=>$imgURL
			
    	); 
}
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>