<link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	table td {vertical-align: middle !important;}
</style>
<?php echo form_open('tabulation_sheet/update', array('id' => 'tabulation_form', 'class' => 'form')); ?>
			<input type="hidden" name="class_name_id" value="<?php echo $class_name_id; ?>">
			<input type="hidden" name="section_name_id" value="<?php echo $section_name_id; ?>">
			<input type="hidden" name="exam_name_id" value="<?php echo $exam_name_id; ?>">
	<fieldset>
		<h6 style="text-align:center;"><?php echo $school_name; ?></h6>
		<div class="formRow">
			<div class="custom_table">
				<table style="width:100%; vertical-align:middle;">
					<tbody>
						<tr class="yellow">
							<td>ID</td>
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
								<td><?php echo $student->display_id; ?></td>
								<td>
									<?php echo $student->name; ?>(<?php echo $student->roll_no; ?>)
								</td>
								<?php if($student->results): ?>
									<?php foreach($student->results as $result): ?>
										<td>
											<input 
												id="marks_<?php echo $result->student_result_id; ?>" 
												type="text" name="marks_<?php echo $result->student_result_id; ?>" 
												value="<?php echo $result->marks; ?>"  
												style="width:40px;" class="subject_marks" 
												data="<?php echo $result->student_result_id; ?>">
										</td>
										<td>
											<select id="grade_id_<?php echo $result->student_result_id; ?>" name="grade_<?php echo $result->student_result_id; ?>">
										<?php if($result->grade_id): ?>
										<option value="<?php echo $result->grade_id; ?>" ><?php echo $result->grade_id; ?></option>
										<?php else: ?>
										<option value="F">F</option>
										<?php endif; ?>		

										<option value="A+">A+</option>
								                <option value="A">A</option>
								                <option value="A-">A-</option>
								                <option value="B+">B+</option>
								                <option value="B">B</option>
								                <option value="C">C</option>
								                <option value="F">F</option>
											</select>
										</td>
									<?php endforeach; ?>
								<?php else: ?>
									<?php for($i=0; $i<count($subjects); $i++): ?>
										<td colspan='2'>Not found</td>
									<?php endfor; ?>
								<?php endif; ?>
								<?php if($student->result_summary): ?>
									<?php foreach($student->result_summary as $summary): ?>
										<td>
											<input type="text" name="s_marks_<?php echo $summary->result_summary_id; ?>" value="<?php echo $result_summary['total_marks'][$student->student_id]; ?>" style="width:80px;">
										</td>
										<td>
											<input type="text" name="s_position_<?php echo $summary->result_summary_id; ?>" value="<?php echo $result_summary['rank'][$student->student_id]; ?>" style="width:80px;">
										</td>
										<td>
											<input type="text" name="s_cgpa_<?php echo $summary->result_summary_id; ?>" value="<?php echo $result_summary['gpa'][$student->student_id]; ?>" style="width:80px;">
										</td>
									<?php break; endforeach; ?>
								<?php else: ?>
									<td>
										<input type="text" name="s_marks_<?php echo $student->student_id; ?>" style="width:80px;" value="<?php echo $result_summary['total_marks'][$student->student_id]; ?>">
									</td>
									<td>
										<input type="text" name="s_position_<?php echo $student->student_id; ?>" style="width:80px;" value="<?php echo $result_summary['rank'][$student->student_id]; ?>">
									</td>
									<td>
										<input type="hidden" name="new_<?php echo $student->student_id; ?>" value="1">
										<input type="text" name="s_cgpa_<?php echo $student->student_id; ?>" style="width:80px;" value="<?php echo $result_summary['gpa'][$student->student_id]; ?>">
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
			<input id="submit" type="submit" name="submit" value="submit" class="redB">
			<input type="hidden" name="print" value="1">
			<button id="print" class="redB">Print</button>
		</div>
		<div class="clear"></div>
	</fieldset>
<?php echo form_close(); ?>
<?php echo form_open('tabulation_sheet/printResult', array('style' => 'visibility:none;', 'id' => 'print_form', 'target' => '_blank')); ?>
	<input type="hidden" name="class_name_id" value="<?php echo $class_name_id; ?>">
	<input type="hidden" name="section_name_id" value="<?php echo $section_name_id; ?>">
	<input type="hidden" name="exam_name_id" value="<?php echo $exam_name_id; ?>">
	<input type="hidden" name="print" value="1">
<?php echo form_close(); ?>

<script type="text/javascript">
	$("#print").click(function() {
		$("#print_form").submit();
		return false;
	});
</script>
<script type="text/javascript">
    $(".subject_marks").keyup(function() {
        var marks = $(this).val();
        var student_id = $(this).attr('data');
        if(marks>=90 && marks<=100) {
            $("#grade_id_" + student_id).val("A+");
        } else if(marks>=80 && marks<90) {
            $("#grade_id_" + student_id).val("A");
        } else if(marks>=70 && marks<80) {
            $("#grade_id_" + student_id).val("A-");
        } else if(marks>=60 && marks<70) {
            $("#grade_id_" + student_id).val("B+");
        } else if(marks>=50 && marks<60) {
            $("#grade_id_" + student_id).val("B");
        } else if(marks>=40 && marks<50) {
            $("#grade_id_" + student_id).val("C");
        } else {
            $("#grade_id_" + student_id).val("F");
        }
    });
</script>