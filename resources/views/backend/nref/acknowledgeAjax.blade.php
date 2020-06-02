<?php
//echo "<pre>"; print_r($candidates); die;

$data = array();
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
	
$data[] = array(
	
	        "fellowname"=>$attendance->firstname,
    		"stream"=>$attendance->course,
			"genAcknow"=>'<a href="resources\views\backend\nref\Acknowledgment_receipt.docx" download">Download</a>',
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