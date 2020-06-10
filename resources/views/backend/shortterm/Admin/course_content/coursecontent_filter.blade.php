<?php


$data = array();
foreach($short_term_data as $std)
{
	
	                 if($std->course_content_doc){ 
						
						$c = '<a href="'.url("public/uploads/shortterm/course/").'/'.$std->course_content_doc.'" target="_blank" download>Click Here</a>';
						 } else {
						$c = "Not Uploaded";
						 } 
						   if($std->padaggogy_doc){ 
						
						$p = '<a href="'.url("public/uploads/shortterm/course/").'/'.$std->padaggogy_doc.'" target="_blank" download>Click Here </a>';
						 } else {
						$p = "Not Uploaded";
						 } 
						   if($std->practical_content_doc){ 
						
						$pr = '<a href="'.url("public/uploads/shortterm/course/").'/'.$std->practical_content_doc.'" target="_blank" download>Click Here</a>';
						 } else {
						$pr = "Not Uploaded";
						 } 
	    
	 
$i='1';
$data[] = array(
	        "srn"=>$i,
			"coordinator_name"=>$std->coordinator_name,
			"course_content"=>$c,
			"debagogy"=>$p,
			"practical_content"=>$pr,
			
			
    	); 
		$i++;
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>