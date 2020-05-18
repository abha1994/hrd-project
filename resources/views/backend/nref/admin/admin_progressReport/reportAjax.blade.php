<?php
//echo "<pre>"; print_r($candidates); die;

$data = array();

foreach($attendanceList as $attendance)
{
	
	if($attendance->report_file!="")
	{
		$imgURL='<a href="'.URL::asset("public/uploads/nref/progress_report").'/'.$attendance->report_file.'" target="_blank">Click Here</a>';
	}
	else
	{
		$imgURL='-';
	}
	
$data[] = array(
	
	        "fellowname"=>$attendance->firstname.' '.$attendance->middlename.' '.$attendance->lastname,
    		"stream"=>$attendance->course,
			"reportType"=>ucfirst($attendance->report_type),
			"monthType"=>ucfirst($attendance->report_month),
			"yearType"=>ucfirst($attendance->report_year),
			"clickTocheck"=>$imgURL
			
    	); 
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>