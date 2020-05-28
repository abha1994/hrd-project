<?php
//echo "<pre>"; print_r($candidates); die;

$data = array();

foreach($attendanceList as $attendance)
{
	
	if($attendance->short_term_attandance!="")
	{
		$imgURL='<a href="'.URL::asset("public/uploads/shortterm/attadance").'/'.$attendance->short_term_attandance.'" target="_blank">Click Here</a>';
	}
	else
	{
		$imgURL='-';
	}
	
$data[] = array(
	
	        "fellowname"=>$attendance->firstname.' '.$attendance->middlename.' '.$attendance->lastname,
    		"stream"=>ucfirst($attendance->course_type),
			"clickTocheck"=>$imgURL
			
    	); 
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>