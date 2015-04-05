<script language="javascript">	
    function fadeMessage(msgDivId)
	{
		$(msgDivId).fadeOut('slow');
	}
</script>
<?php
	if(isset($_SESSION['message']))
	{
		$message = $_SESSION['message'];
		unset($_SESSION['message']);
	
?>
	<div class="v_s_gap"></div>
    <div id="messageBox"><?=$message?></div>
    <script language="javascript">
        $('#display_message_id').show();
		setTimeout("fadeMessage('#messageBox')", 10000);
        $('#display_message_id').hide();
	</script>
<?php
	}
	else if(isset($_SESSION['exception']))
	{
		$exception = $_SESSION['exception'];
		unset($_SESSION['exception']);
?>
    <div class="v_s_gap"></div>
	<div id="exceptionBox"><?=$exception?></div>
    <script language="javascript">
		setTimeout("fadeMessage('#exceptionBox')", 10000);
	</script>
<?php
	}

	if(isset($_SESSION['notification']))
	{
		$notification = $_SESSION['notification'];
		unset($_SESSION['notification']);
?>
	<div class="v_s_gap"></div>
    <div class="notificationBox"><?=$notification?></div>
<?php
	}
?>