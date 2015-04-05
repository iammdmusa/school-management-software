<?php
if($attendence)
{
    if($attendence[0]['is_message_sent'] == '0')
    {
?>
    <input id="send_button_id"  type="button" value="Send SMS" class="redB send_button_idCSS" onclick="send_gurdian_sms1(document.forms.validate);" />
    <?
    }
    ?>
    <input type="submit" value="edit" class="redB" />
<?php
}
else
{
?>
<input type="submit" value="save" class="redB" />
<?
}
?>