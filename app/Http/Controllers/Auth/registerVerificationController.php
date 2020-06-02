
<?php //echo "<pre>"; print_r($institute_data); die; ?>

<style>

.heading{
	    background: #2291bb;
		font-size: 27px;
		color:white;    width:100%;
    height: 10%;

}
}
</style>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <body>
  
  <center><h4 class="heading">List of Selected Application After Committee Recommendation</h4></center>


    <table size="1" face="Courier New" id="table" border="1" cellspacing="0" class="table table-bordered">
    <thead>
	
      <tr style="font-size: 13px;">
        <td style="width:1%; text-align:center;"><b>Sr. No.</b></td>
        <td style="width:10%"><b>Institute Details</b></td> 
		<td style="width:12%; text-align:center;"><b>Course Details</b></td>  
		<td style="width:12%; text-align:center;"><b>Fellowship Slot Details</b></td>  
     </tr>
      </thead>
      <tbody>
	  <?php  $p=1;foreach($institute_data['institute_details'] as $instName){?>
<tr style="font-size:11px;">
<td><?php echo $p; ?></td>
<td style="width:8%">
<?php

echo "<b class='font'>Institute Name:</b>".$instName->institute_name."<br>";
echo "<b class='font'>Name of the Department:</b>".$instName->department_name."<br>";
echo "<b class='font'>Coordinator of the Proposed Program:</b>".$instName->coordinate_prog."<br>";
echo "<b class='font'>Type of Institution:</b>";
foreach($institute_data['type_inst'] as $val)
if($instName->institute_type_id == $val->institute_type_id){echo $val->institute_desc;}
echo "<br><b class='font'>University/Institute Ranking as per UGC/NIRF:</b>".$instName->university_rank."<br>";
echo "<b class='font'>Course Listing:</b><br>";
// if(isset($institute_data['courses_list'])) {
// foreach($institute_data['courses_list'] as $val)

// if(count($curse)>0) { 
// for($k=0;$k<count($curse);$k++) {
// if($curse[$k]==$val->course_id) {
	// $k=$k+1;
// echo $k .')'.$val->course_name."<br>";
// } } }
// }
echo "<br><b class='font'>Years of Establishment:</b>".$instName->year_establishment."<br>";

?>
</td>
<td>
<?php 
echo "<b class='font'>Any Collaborative Institute:</b>".ucfirst($instName->any_collaboration)."<br>";
if($instName->any_collaboration=='yes')
{
if(isset($instName->research_phd))
{
	$ss=explode(',',$instName->research_phd);
	
	if(count($ss)>0) { 
	for($i=0;$i<count($ss);$i++) {
		$j =$i+1;
	if($ss[$i]=='Research') {
		echo $j.')'."Research"."<br>";
	} 
	
	if($ss[$i]=='Ph. D Registration') {
		echo $j.')'."Ph. D Registration"."<br>";
	} 
	
	if($ss[$i]=='Post Graduate Program') {
		echo $j.')'."Post Graduate Program"."<br>";
	} 
	
	} 
	}
}
}

echo "<b class='font'>Experience in Energy related courses:</b>".$instName->energy_experience."<br>";
echo "<b class='font'>A)Date of approximate course Start:</b>".date('Y-m-d',strtotime($instName->course_start_date))."<br>";
echo "<b class='font'>B)Number of Seats in each of the course:</b>".$instName->no_of_seat."<br>";
echo "<b class='font'>C)Specialization offered:</b>".$instName->specialization_offered."<br>";
echo "<b class='font'>D)If any industry collaboration is there, if so details thereof:</b>".$instName->industry_collaboration."<br>";
echo "<b class='font'>E)If placement service is being provided:</b>".ucfirst($instName->placement_details)."<br>";
if($instName->other_details) {
echo "<b class='font'>F)Any other details:</b>".$instName->other_details."<br>";
}
echo "<b class='font'>Sponsored Projects in the area of Energy, Environment and Renewable Energy:</b>".ucfirst($instName->spon_project)."<br>";
?>

</td>
<td>
<?php 
echo "<b class='font'>Fellowship slot requirement Period:</b>".$instName->fellowship_period."<br>";
if($instName->fellowship_mtech){
echo "<b class='font'>M.tech:</b>".$instName->fellowship_mtech."<br>";
}
if($instName->fellowship_jrf){
echo "<b class='font'>JRF:</b>".$instName->fellowship_jrf."<br>";
}

if($instName->fellowship_srf){
echo "<b class='font'>SRF:</b>".$instName->fellowship_srf."<br>";
}

if($instName->fellowship_msc){
echo "<b class='font'>M.SC. Renewable Energy:</b>".$instName->fellowship_msc."<br>";
}

if($instName->fellowship_ra){
echo "<b class='font'>RA:</b>".$instName->fellowship_ra."<br>";
}

if($instName->fellowship_pdf){
echo "<b class='font'>PDF:</b>".$instName->fellowship_pdf."<br>";
}

if($instName->fellowship_total){
echo "<b class='font'>Total:</b>".$instName->fellowship_total."<br>";
}

?>
</td>
</tr> 

<?php $p++; } ?> 
      </tbody>
    </table>
	<div style="position:fixed;bottom:0px;">
     <p><strong>Ministry of New and Renewable Energy</strong>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></div>