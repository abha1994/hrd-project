
<?php //echo "<pre>"; print_r($shortterm_data); die; ?>

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
  
  <center><h4 class="heading">List of Short Term Application</h4></center>


    <table size="1" face="Courier New" id="table" border="1" cellspacing="0" class="table table-bordered">
    <thead>
	
      <tr style="font-size: 13px;">
        <td style="width:1%; text-align:center;"><b>Sr. No.</b></td>
        <td style="width:10%"><b>Short Term Name</b></td> 
		<td style="width:12%; text-align:center;"><b>Program Name</b></td>  
		<td style="width:12%; text-align:center;"><b>Coordinator Name</b></td>
        <td style="width:12%; text-align:center;"><b>Coordinator Mobile</b></td>		
     </tr>
      </thead>
      <tbody>
	  <?php  $p=1;foreach($shortterm_data['shortTerm_details'] as $shortName){?>
<tr style="font-size:11px;">
<td><?php echo $p; ?></td>
<td style="width:8%">
<?php
echo $shortName->institute_name;
?>
</td>
<td>
<?php 
echo $shortName->name_proposed_training_program;
?>

</td>
<td>
<?php 
echo $shortName->coordinator_name;

?>
</td>
<td>
<?php 
echo $shortName->coordinator_mobile;

?></td>
</tr> 

<?php $p++; } ?> 
      </tbody>
    </table>
	<div style="position:fixed;bottom:0px;">
     <p><strong>Ministry of New and Renewable Energy</strong>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></div>