<?php //echo "<pre>"; print_r($attendanceList);  die; ?>
<table  width="100%"  class="table table-bordered data-table">
			    <thead>
				       <tr>
							<th class="filterhead">Student Name</th>
							<th class="filterhead">Course</th>
							<th class="filterhead">Working Days</th>
							<th class="filterhead">Holidays</th>
							<th class="filterhead">Present Days</th>
							<th class="filterhead">Absent Days</th>
							<th class="filterhead">Leave Approved Days</th>
							<th class="filterhead">Total Days</th>
							<th class="filterhead">Remarks</th>
							 
					  </tr>
					
					  <?php if(count($attendanceList)>0) { $i=0;foreach($attendanceList as $attendance) { ?>
					  <tr>
					  	<td>
						
						{{$attendance->firstname.' ' .$attendance->middlename.' '.$attendance->lastname}}
						</td>
						
						<td>
						{{$attendance->course}}
						</td>
						
					  	<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->working_days; ?>" id="working_days{{$i}}" placeholder="Working Days" name="working_days[]"  disabled <?php //if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>>
						</td>
						<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->holidays; ?>" id="holiday{{$i}}" placeholder="Holidays" name="holiday[]" disabled <?php //if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>>
						</td>
						<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->present_days; ?>" id="present_days{{$i}}" placeholder="Present Days" name="present_days[]" disabled <?php //if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>>
						</td>
						<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->absent_days; ?>" id="absent_days{{$i}}" placeholder="Absent Days" name="absent_days[]" disabled <?php //if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>> 
						</td>
						
						<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->leave_approved_days; ?>" id="leave_approval{{$i}}" placeholder="Leave Approved Days" name="leave_approval[]" disabled <?php //if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>> 
						</td>
						
						<td> 
						<input class="form-control enabledisable" type="number" value="<?php echo $attendance->total_days; ?>" id="total_days{{$i}}" placeholder="Total Days" name="total_days[]" disabled <?php //if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?> readonly> 
						</td>
						
						<td> 
						<input class="form-control enabledisable" type="text" value="<?php echo $attendance->remarks; ?>" id="remarks{{$i}}" placeholder="Remarks" name="remarks[]" disabled <?php //if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>> 
						</td>
						
					  </tr>
					  <?php $i++;} } else { ?>
					  
					  <tr>
					  <td colspan="9"><center>No data available </center></td>
					  </tr>
					  
					  <?php } ?>
					  

				</thead>
				</table>