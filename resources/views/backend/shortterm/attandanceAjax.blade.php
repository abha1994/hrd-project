<?php
//echo "<pre>"; print_r($attendanceList); die;

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
    		"stream"=>$attendance->course_type,
			"uploadSlip"=>'<button type="button"  stdID="'.$attendance->id.'" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal" class="uploadValue">Upload</button>',
			"clickTocheck"=>$imgURL
			
    	); 
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>