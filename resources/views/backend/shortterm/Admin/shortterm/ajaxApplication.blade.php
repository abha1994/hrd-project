<?php
//echo "<pre>"; print_r($shortTermList); die;

$data = array();

foreach($shortTermList as $attendance)
{
	
	if(!empty($attendance->signature_doc))
	{
	$edit='<a class="btn btn-success" href="'.route('short-term-application.edit',$attendance->short_term_id).'">Edit</a>';
	}
	else{
		$edit='';
	}
	
	/* $form ='<form style="display:inline" method="DELETE" action="'.route('short-term-application.destroy',$attendance->short_term_id).'">
	
	<input type = "hidden" name = "_token" value = "'.csrf_token().'">
	<input type = "hidden" name="_method" value="" id="DELETE">
	
	<input  class="btn btn-danger confirmation" id="delete" type="submit" value="Delete" />
	
	</form>'; */
	
	$form='<a class="btn btn-danger confirmation" id="delete" href="#">Delete</a>';
	
$data[] = array(
	
	        "program"=>$attendance->name_proposed_training_program,
    		"cordinateName"=>$attendance->coordinator_name,
			"cordinateMobile"=>$attendance->coordinator_mobile,
			"action"=>'<a style="color: white" class="btn btn-info" href="'.route('short-term-application.show',$attendance->short_term_id).'">Show</a>'.' '.$edit.' '.$form
			
    	); 
}
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>