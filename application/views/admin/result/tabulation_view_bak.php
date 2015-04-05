<link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
table td {vertical-align: middle !important;}
</style>
<?php echo form_open('tabulation_sheet/update', array('class' => 'form', 'target' => '_blank')); ?>
	<fieldset>
		<h6 style="text-align:center;"><?php echo $school_name; ?></h6>
		<div class="formRow">
			<div class="custom_table">
				<table style="width:100%; vertical-align:middle;">
					<tbody>
						<tr class="yellow">
							<td>StudentID</td>
							<td>Student name(roll)</td>
							<?php if(count($subjects)): ?>
								<?php for($i=0; $i<count($subjects); $i++): ?>
									<td colspan='2'><?php echo $subjects[$i]; ?></td>
								<?php endfor; ?>
							<?php else: ?>
								<td>Results</td>
							<?php endif; ?>
							<td>Total marks</td>
							<td>Position</td>
							<td>GPA</td>
						</tr>
						<?php foreach($students as $student): ?>
							<tr><td><?php echo $student->total_marks; ?></td></tr>
							<tr>
								<td><?php echo $student->student_id; ?></td>
								<td>
									<?php echo $student->name; ?>(<?php echo $student->roll_no; ?>)
								</td>
								<?php if($student->results): ?>
									<?php foreach($student->results as $result): ?>
										<td>
											<input type="text" name="marks_<?php echo $result->student_result_id; ?>" value="<?php echo $result->marks; ?>"  style="width:40px;">
										</td>
										<td>
											<select name="grade_<?php echo $result->student_result_id; ?>">
												<option value="<?php echo $result->grade_id; ?>" ><?php echo $result->grade_id; ?></option>
												<option value="A+" >A+</option>
								                <option value="A" >A</option>
								                <option value="A-" >A-</option>
								                <option value="B+" >B+</option>
								                <option value="B" >B</option>
								                <option value="B-" >B-</option>
								                <option value="C+" >C+</option>
								                <option value="C" >C</option>
								                <option value="C-" >C-</option>
								                <option value="D+" >D+</option>
								                <option value="D" >D</option>
								                <option value="D-" >D-</option>
								                <option value="F" >F</option>
											</select>
										</td>
									<?php endforeach; ?>
								<?php else: ?>
									<td>No Results found</td>
								<?php endif; ?>
								<?php if($student->result_summary): ?>
									<?php foreach($student->result_summary as $summary): ?>
										<td>
											<input type="text" name="s_marks_<?php echo $summary->result_summary_id; ?>" value="<?php echo $summary->marks; ?>" style="width:80px;">
										</td>
										<td>
											<input type="text" name="s_position_<?php echo $summary->result_summary_id; ?>" value="<?php echo $summary->position; ?>" style="width:80px;">
										</td>
										<td>
											<input type="text" name="s_cgpa_<?php echo $summary->result_summary_id; ?>" value="<?php echo $summary->cgpa; ?>" style="width:80px;">
										</td>
									<?php endforeach; ?>
								<?php else: ?>
									<td>
										<input type="text" name="s_marks_<?php echo $student->student_id; ?>" style="width:80px;" value="<?php echo $summary['total_marks'][$student->student_id]; ?>">
									</td>
									<td>
										<input type="text" name="s_position_<?php echo $student->student_id; ?>" style="width:80px;" value="<?php echo $summary['rank'][$student->student_id]; ?>">
									</td>
									<td>
										<input type="hidden" name="new_<?php echo $student->student_id; ?>" value="1">
										<input type="text" name="s_cgpa_<?php echo $student->student_id; ?>" style="width:80px;" value="<?php echo $summary['gpa'][$student->student_id]; ?>">
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formSubmit">
			<input type="hidden" name="class_name_id" value="<?php echo $class_name_id; ?>">
			<input type="hidden" name="section_name_id" value="<?php echo $section_name_id; ?>">
			<input type="hidden" name="exam_name_id" value="<?php echo $exam_name_id; ?>">
			<input type="submit" name="submit" value="submit" class="redB">
		</div>
		<div class="clear"></div>
	</fieldset>
<?php echo form_close(); ?>