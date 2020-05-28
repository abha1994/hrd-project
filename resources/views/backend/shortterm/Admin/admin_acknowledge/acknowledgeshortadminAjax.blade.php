<?php
$data = array();
if(isset($attendanceList)) {
foreach($attendanceList as $attendance)
{
	
	if($attendance->fileSign!="")
	{
		$imgURL='<a href="'.URL::asset("public/uploads/shortterm/acknowledge").'/'.$attendance->fileSign.'" target="_blank">Click Here</a>';
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
	
	        "fellowname"=>$attendance->firstname.' '.$attendance->middlename.' '.$attendance->lastname,
			"instname"=>$ss,
    		"stream"=>ucfirst($attendance->course_type),
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