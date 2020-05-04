<?php
//echo "<pre>"; print_r($candidates); die;

$data = array();
$i=1;

$monthArray=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');

foreach($attendanceList as $attendance)
{
	
	
$data[] = array(
	
	        "srno"=>$i,
    		"month"=>$monthArray[$attendance->month_atten] .' '.$attendance->year_atten ,
			"workingDays"=>$attendance->working_days,
			"holidays"=>$attendance->holidays,
			"presentDays"=>$attendance->present_days,
			"absentDays"=>$attendance->absent_days,
			"leaveApp"=>$attendance->leave_approved_days,
			"totalDays"=>$attendance->total_days,
			"remarks"=>$attendance->remarks,
			"actions"=>'<a href="'.url('view_attendance/'.$attendance->attendence_id).'" target="_blank"> View </a>'
			
    	); 
		$i++;
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>