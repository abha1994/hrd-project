<?php
$data = array();
if(isset($feedbackList)) {
foreach($feedbackList as $feed)
{

$data[] = array(
	
	        "fellowname"=>$feed->firstname.' '.$feed->middlename.' '.$feed->lastname,
			"email"=>$feed->email_id,
    		"starRating"=>$feed->star_rating,
			"suggestions"=>$feed->suggestions,
			"clickTocheck"=>'<a href="'.route('view-evaluation',$feed->id ).'"><i class="fa fa-eye"></i></a>'
			
    	); 
}
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>