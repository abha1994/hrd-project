<?php //echo "<pre>"; print_r($students);  die; ?>
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
						<input type="hidden" name="user_id[]" value="{{$attendance->id}}" />
						{{$attendance->student_name}}
						</td>
						
						<td>
						{{$attendance->course}}
						</td>
						
					  	<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->working_days; ?>" id="working_days{{$i}}" placeholder="Working Days" name="working_days[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>>
						</td>
						<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->holidays; ?>" id="holiday{{$i}}" placeholder="Holidays" name="holiday[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>>
						</td>
						<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->present_days; ?>" id="present_days{{$i}}" placeholder="Present Days" name="present_days[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>>
						</td>
						<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->absent_days; ?>" id="absent_days{{$i}}" placeholder="Absent Days" name="absent_days[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>> 
						</td>
						
						<td> 
						<input class="form-control enabledisable" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php echo $attendance->leave_approved_days; ?>" id="leave_approval{{$i}}" placeholder="Leave Approved Days" name="leave_approval[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>> 
						</td>
						
						<td> 
						<input class="form-control enabledisable" type="number" value="<?php echo $attendance->total_days; ?>" id="total_days{{$i}}" placeholder="Total Days" name="total_days[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?> readonly> 
						</td>
						
						<td> 
						<input class="form-control enabledisable" type="text" value="<?php echo $attendance->remarks; ?>" id="remarks{{$i}}" placeholder="Remarks" name="remarks[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>> 
						</td>
						
					  </tr>
					  <?php $i++;} }  else { ?>
					  <?php $i=0; ?>
					 <?php //echo "<pre>"; print_r($students); ?>
					  @foreach($students as $student)
					  <tr class="">
					  	<!--<td>{{$loop->iteration}}</td>-->
					  	<td>
						<input type="hidden" name="user_id[]" value="{{$student->id}}" />
						{{$student->firstname}}</td>
						
						<td>
						{{$student->course}}
						</td>
						
					  	<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->working_days)) { echo $attendanceList[$i]->working_days; } ?>" id="working_days{{$i}}" placeholder="Working Days" name="working_days[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>>
						</td>
						<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->holidays)) { echo $attendanceList[$i]->holidays; } ?>" id="holiday{{$i}}" placeholder="Holidays" name="holiday[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>>
						</td>
						<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->present_days)) { echo $attendanceList[$i]->present_days; } ?>" id="present_days{{$i}}" placeholder="Present Days" name="present_days[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?> onkeyup="sum()">
						</td>
						<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->absent_days)) { echo $attendanceList[$i]->absent_days; } ?>" id="absent_days{{$i}}" placeholder="Absent Days" name="absent_days[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?> readonly> 
						</td>
						
						<td> 
						<input class="form-control" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" type="text" min="0" maxlength="2" value="<?php if(isset($attendanceList[$i]->leave_approved_days)) { echo $attendanceList[$i]->leave_approved_days; } ?>" id="leave_approval{{$i}}" placeholder="Leave Approved Days" name="leave_approval[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?> onkeyup="sum()"> 
						</td>
						
						<td> 
						<input class="form-control" type="number" value="<?php if(isset($attendanceList[$i]->total_days)) { echo $attendanceList[$i]->total_days; } ?>" id="total_days{{$i}}" placeholder="Total Days" name="total_days[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?> readonly> 
						</td>
						
						<td> 
						<input class="form-control" type="text" value="<?php if(isset($attendanceList[$i]->remarks)) { echo $attendanceList[$i]->remarks; } ?>" id="remarks{{$i}}" placeholder="Remarks" name="remarks[]" <?php if($monthValueArray[0]!=$monthValueArray[1]) { echo "disabled"; }?>> 
						</td>
					  </tr>
					  <?php $i++; ?>
					  @endforeach
					  
					  <?php } ?>

				</thead>
				</table>