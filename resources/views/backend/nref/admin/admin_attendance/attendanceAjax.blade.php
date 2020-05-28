<?php
//echo "<pre>"; print_r($attendanceList); echo count($attendanceList); die;

$data = array();
if(count($attendanceList)>0) {
foreach($attendanceList as $attendance)
{
	
$data[] = array(
	
	        "fellowname"=>$attendance->firstname.' ' .$attendance->middlename.' '.$attendance->lastname,
    		"stream"=>$attendance->course_name,
			"working"=>$attendance->working_days,
			"holiday"=>$attendance->holidays,
			"present"=>$attendance->present_days,
			"absent"=>$attendance->absent_days,
			"leave"=>$attendance->leave_approved_days,
			"total"=>$attendance->total_days,
			"remark"=>$attendance->remarks,
			
    	); 
}
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>