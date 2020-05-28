<?php
//echo "<pre>"; print_r($candidates); die;

$data = array();
// dd($data);
// foreach($data as $v)
// {
	
	if($v->utilization_cetificate_doc!="")
	{
		$utilization_cetificate_doc='<a href="'.URL::asset("public/uploads/shortterm/report/utilize").'/'.$v->utilization_cetificate_doc.'" target="_blank">Click Here</a>';
	}
	else
	{
		$utilization_cetificate_doc='No Data Uploaded';
	}
	
	if($v->audited_statement_doc!="")
	{
		$audited_statement_doc='<a href="'.URL::asset("public/uploads/shortterm/report/practical").'/'.$v->audited_statement_doc.'" target="_blank">Click Here</a>';
	}
	else
	{
		$audited_statement_doc='No Data Uploaded';
	}
	
	if($v->programme_completion_doc!="")
	{
		$programme_completion_doc='<a href="'.URL::asset("public/uploads/shortterm/report/program").'/'.$v->programme_completion_doc.'" target="_blank">Click Here</a>';
	}
	else
	{
		$programme_completion_doc='No Data Uploaded';
	}
	
	if($v->impact_tranning!="")
	{
		$impact_tranning='<a href="'.URL::asset("public/uploads/shortterm/report/tainning").'/'.$v->impact_tranning.'" target="_blank">Click Here</a>';
	}
	else
	{
		$impact_tranning='No Data Uploaded';
	}
	
$data[] = array(
	        "utilization_cetificate_doc"=>$utilization_cetificate_doc,
	        "audited_statement_doc"=>$audited_statement_doc,
    		"programme_completion_doc"=>$programme_completion_doc,
			"impact_tranning"=>$impact_tranning
			
    	); 
// }
		
		$response = array(
    "draw" => intval(1),
    "aaData" => $data
);

echo json_encode($response);
?>