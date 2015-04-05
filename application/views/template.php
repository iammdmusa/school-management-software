<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<script>var baseUrl = '<?php echo BASEURL?>';</script>
<?php include 'application/views/includes/h_script.php'?>

</head>
<body>
	
	<?php include 'application/views/includes/header.php'?>	
	
	<!-- Main content -->
	<div class="container_12">
		<?php echo isset($mainContent) ? $mainContent : ''; ?>
	</div> 
 	<?php include 'application/views/includes/footer.php'?>
</body>
</html>
