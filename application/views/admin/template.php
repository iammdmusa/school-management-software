<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script>var baseUrl = '<?php echo BASEURL?>';</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<title>Welcome to Xenon School Management System</title>
	<link href="<?php echo BASEURL?>admin-img-css-js/css/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/spinner/ui.spinner.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/spinner/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/uniform.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/jquery.cleditor.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/jquery.tagsinput.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/autogrowtextarea.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/jquery.dualListBox.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/jquery.inputlimiter.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/forms/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/wizard/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/wizard/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/wizard/jquery.form.wizard.js"></script>
        
<!--	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/uploader/plupload.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/uploader/plupload.html5.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/uploader/plupload.html4.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/uploader/jquery.plupload.queue.js"></script>-->
        
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/tables/datatable.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/tables/tablesort.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/tables/resizable.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.tipsy.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.collapsible.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.progress.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.timeentry.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.colorpicker.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.jgrowl.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.breadcrumbs.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/ui/jquery.sourcerer.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/calendar.min.js"></script>
	<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/plugins/elfinder.min.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/js/custom.js"></script>
    
	<style>
	.content_area{width:94%;margin:0 auto;}
	</style>
</head>
	<body>
		<?php include 'application/views/admin/includes/leftbar.php'?>
		<!-- Right side -->
		<div id="rightSide">
			<?php include 'application/views/admin/includes/top-nav-bar.php'?>
			<?php include 'application/views/admin/includes/title-area.php'?>
			<div class="content_area">
			<?php echo isset($mainContent) ? $mainContent : ''; ?>
			</div>
			<?php include 'application/views/admin/includes/footer.php'?>
		</div>

		<div class="clear"></div>
	</body>
</html>