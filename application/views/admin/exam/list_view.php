<link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	table td {vertical-align: middle !important;}
</style>

<div class="formRow">
	<div class="custom_table">
		<table style="width:100%; vertical-align:middle;">
			<tbody>
				<tr class="yellow">
					<td>Exam ID</td>
					<td>Exam name</td>
					<td style="text-align:right;">Action</td>
				</tr>
				<?php foreach($exams as $exam): ?>
					<tr>
						<td><?php echo $exam->exam_id; ?></td>
						<td><?php echo $exam->exam_name; ?></td>
						<td style="text-align:right;">
				            <a class="delete" href="<?php echo site_url('exam/delete/'.$exam->exam_id); ?>">Delete Exam</a> |
				            <a href="<?php echo site_url('exam/edit/'.$exam->exam_id); ?>">Edit</a>
				        </td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	$(".delete").click(function() {
		var con = confirm("Are you sure to delete exam?");
		if(!con) {
			return false;
		}
	});
</script>