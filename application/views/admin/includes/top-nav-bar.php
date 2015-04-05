<!-- Top fixed navigation -->
<div class="topNav">
	<div class="wrapper">
		<div class="welcome"><a href="javascript:void(0);" title=""><img src="<?php echo BASEURL?>admin-img-css-js/images/userPic.png" alt="" /></a><span><?php echo $_SESSION['admin_email']?><?php echo ($_SESSION['is_school_admin'] == '1') ? '[school admin]':'';?> <?php echo $_SESSION['school_name'] ? '- '.$_SESSION['school_name']:'';?></span></div>
		<div class="userNav">
			<ul>
				<li><a href="<?php echo BASEURL?>admin/logout" title=""><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
</div>