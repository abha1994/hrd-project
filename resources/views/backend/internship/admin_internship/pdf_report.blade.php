

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
  <?php 
$intern_duration = $internship_data['intern_duration'];
$pass_status = $internship_data['pass_status'];
$start_date = $internship_data['datepicker_search_from'];
$end_date = $internship_data['dt21'];
$interndatatype = $internship_data['interndatatype'];


if(!empty($intern_duration) && !empty($pass_status) && !empty($start_date) && !empty($end_date)){?>
<center><h4 class="heading">Submitted List for Internship From <?php echo date("d-M-Y",strtotime($start_date))?> To  <?php echo date("d-M-Y",strtotime($end_date))?> (Internship duration - <?php echo $intern_duration;?> months) For <?php if($pass_status == "1"){ echo "Pursuing";}else { echo "Passed";}?>  Students</h4></center>

<?php }else if(!empty($intern_duration) && !empty($pass_status)){ ?>

<center><h4 class="heading">Submitted List for Internship (Internship duration - <?php echo $intern_duration;?> months) For 
<?php if($pass_status == "1"){ echo "Pursuing";}else { echo "Passed";}?>  Students</h4></center>

<?php }else if(!empty($intern_duration) && !empty($start_date) && !empty($end_date)){ ?>

<center><h4 class="heading">Submitted List for Internship From <?php echo date("d-M-Y",strtotime($start_date))?> To  <?php echo date("d-M-Y",strtotime($end_date))?> (Internship duration - <?php echo $intern_duration;?> months)</h4></center>

<?php }else if(!empty($start_date) && !empty($end_date) && !empty($pass_status)){ ?>

<center><h4 class="heading">Submitted List for Internship From <?php echo date("d-M-Y",strtotime($start_date))?> To  <?php echo date("d-M-Y",strtotime($end_date))?>  For <?php if($pass_status == "1"){ echo "Pursuing";}else { echo "Passed";}?>  Students</h4></center>

<?php }else if(!empty($intern_duration)){ ?>

<center><h4 class="heading">Submitted List for Internship (Internship duration - <?php echo $intern_duration;?> months)</h4></center>

<?php }else if(!empty($pass_status)){?>
<center><h4 class="heading">Submitted List for Internship  <?php if($pass_status == "1"){ echo "Pursuing";}else { echo "Passed";}?>Students</h4></center>

<?php }else { ?>
<center><h4 class="heading">Submitted List for Internship </h4></center>
<?php }?>


    <table size="1" face="Courier New" id="table" border="1" cellspacing="0" class="table table-bordered">
    <thead>
	
      <tr style="font-size: 13px;">
        <td style="width:1%; text-align:center;"><b>Sr. No.</b></td>
        <td style="width:10%"><b>Application Details</b></td> 
		<td style="width:12%; text-align:center;"><b>Experience Details</b></td>  
		<td style="width:12%; text-align:center;"><b>Education Details</b></td>  
		<td style="width:20%; text-align:center;"><b>Other Information</b></td>  
     </tr>
      </thead>
      <tbody>
       <?php  $i=1;foreach($internship_data['internship_data'] as $v){?>
		    <tr style="font-size:11px;">
				<td><?php echo $i; ?></td>
		        <td style="width:8%"><?php echo  "<b  class='font'>Name:</b>".$v->first_name ." ".$v->middle_name." ".$v->last_name." "."("?>
					  <?php 
						 if(!empty($v->gender)) { 
							if($v->gender == "1"){
								 echo "Male";
							}elseif($v->gender == "2"){
									 echo "Female";
							}else if($v->gender == "0"){
									echo "Others";
							}
						}else{
							echo "N/A";
						}
					  ?> 
					  <?php echo  ")"."<br>
						<b  class='font'>Father Name:</b>".$v->father."<br>
						<b  class='font'>Date of Birth:</b>".$v->date_birth."<br>
						<b  class='font'>Mobile Number:</b>".$v->mob_number."<br>
						<b  class='font'>Landline:</b>".$v->phone."<br>
						<b  class='font'>Address:</b>".strtolower($v->address).",<br>"?>
						
					  <?php
						foreach($internship_data['district_data'] as $dist)
							 if($v->districtcd == $dist->districtcd){echo strtolower($dist->district_name);}
					  ?>,<?php foreach($internship_data['state_data'] as $stat)
							 if($v->statecd == $stat->statecd){echo strtolower($stat->state_name);}
					  ?>,<?php foreach($internship_data['country_data'] as $cnty)
							 if($v->countrycd == $cnty->countrycd){echo strtolower($cnty->name);}
					  ?><?php echo "-".$v->pincode."<br><b>Email:</b>".$v->email."<br><b>Category:</b>"?>
					  <?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST')?>
					  <?php 
						foreach($categories_arr as $key=>$val){
							if($v->categories == $key){
								 echo $val;
							}
						}
					?>
				</td>
				
				<?php  if(!empty($v->work_status)){  ?>
				    <td id="td2"><?php echo  "<b>Organization:</b>".$v->organization."<br><b>Designation:</b>".$v->designation."<br><b>Organization Address:</b>".$v->organization_address."<br><b>Nature of Area:</b>".$v->nature_area."<br><b>Focus of Work:</b>".$v->focus_work;?></td>
				<?php }  else {  ?>
                    <td id="td2"><?php echo  "N/A"?></td>
                <?php } ?>
				
			
			 
                <td id="td2">
				<b>Course:</b>
				    <?php foreach($internship_data['course_details'] as $c)  {
					 if($c->candidate_id == $v->candidate_id){
					 foreach($internship_data['courses'] as $cd)
						 if($c->course_id == $cd->course_id){echo $cd->course_name."<br>";}
					 
					 }} 
					 ?>
			   
			    <b>Institute:</b><?php foreach($internship_data['course_details'] as $c)  { if($c->candidate_id == $v->candidate_id){?><?php echo  $c->institute."<br>"; }} ?>
			    <b>Stream:</b><?php foreach($internship_data['course_details'] as $c)  { if($c->candidate_id == $v->candidate_id){?><?php echo  $c->stream."<br>"; }} ?>
				<b>Completion Year:</b><?php foreach($internship_data['course_details'] as $c)  {if($c->candidate_id == $v->candidate_id){?><?php if($c->year_completion == 0){echo "N/A"."<br>";}else{echo $c->year_completion."<br>";} }} ?>
                <b>Status:</b><?php foreach($internship_data['course_details'] as $c)  { $a = "Passed"; if($c->candidate_id == $v->candidate_id){?><?php if($c->pass_status == 1){echo "Pursuing"."<br>"; }else{ echo "Passed";   }}} ?>
				<b>Percentage:</b><?php foreach($internship_data['course_details'] as $c)  {  if($c->candidate_id == $v->candidate_id){?><?php echo  $c->marks_percentage."<br>"; }} ?>
				</td>
			 
			 
			 
			 
			 
                <td id="td2">
					<b>Area of Interest:</b>
					<?php  echo $v->area_interest;?><br>
					<?php echo "<b>Internship place:</b>".$v->intern_place."<br>"."<b>Internship Duration:</b>".$v->intern_duration." Months"."<br>"."<b>Start Month & year:</b>"?>
					<?php $intern_start_mnth = array( '1'=>'Jan' ,'2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'June','7'=>'July','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec')?>
					<?php
						foreach($intern_start_mnth as $key=>$val){
							if($v->intern_start_month == $key){
								echo $val."'";
							}
						}
					?>
					<?php echo $v->intern_start_year;?>
				  <b>Write Up Interest:</b><?php if(!empty($v->writeup_interest)){ 
					   echo $v->writeup_interest;
					}else{
					   echo "N/A";
					}?>
					<br>
			    <b>Any Other Information:</b><?php if(!empty($v->remarks)){ 
					    echo $v->remarks;
					}else{
					    echo "N/A";
					} ?>
				
				</td> 
		
		
			
			 </tr>
			 <?php $i++;} ?> 
      </tbody>
    </table>
	<div style="position:fixed;bottom:0px;">
     <p><strong>Ministry of New and Renewable Energy</strong>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></div>