<?php
if($_SESSION['is_superadmin'] == '2')
{
?>
<div class="line"></div>
<!-- Page statistics area -->
<div class="statsRow">
    <div class="wrapper">
        <div class="controlB">
            <ul>
                <li><a href="<?php echo BASEURL?>create/newclass" title="Add new class"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/plus.png" alt="" /><span>Add new class</span></a></li>
                <li><a href="<?php echo BASEURL?>create/attendance" title="Attendance entry"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/database.png" alt="Attendance entry" /><span>Attendance entry</span></a></li>
                <li><a href="<?php echo BASEURL?>create/teacher" title="Add new teacher"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/hire-me.png" alt="" /><span>Add new teacher</span></a></li>
                <li><a href="<?php echo BASEURL?>create/resultlist" title="View Result"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/statistics.png" alt="View Result" /><span>View Result</span></a></li>
                <li><a href="<?php echo BASEURL?>create/custom_message" title="Send Customer Message"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/comment.png" alt="Send Customer Message" /><span>Send Custom Message</span></a></li>
                <!--li><a href="#" title=""><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/order-149.png" alt="" /><span>Check orders</span></a></li-->
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="line"></div>
<?php
}
else if($_SESSION['is_superadmin'] == '0')
{
?>   
<div class="line"></div>
<!-- Page statistics area -->
<div class="statsRow">
    <div class="wrapper">
        <div class="controlB">
            <ul>
                <li><a href="<?php echo BASEURL?>create/attendance" title="Student Attendance"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/plus.png" alt="" /><span>Attendance</span></a></li>
                <li><a href="<?php echo BASEURL?>create/result" title="Create Result"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/database.png" alt="Attendance entry" /><span>Create Result</span></a></li>
                <li><a href="<?php echo BASEURL?>create/resultlist" title="Result List"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/statistics.png" alt="" /><span>View Result</span></a></li>
                <li><a href="<?php echo BASEURL?>create/custom_message" title="Send Customer Message"><img src="<?php echo BASEURL?>admin-img-css-js/images/icons/control/32/comment.png" alt="Send Customer Message" /><span>Send Custom Message</span></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="line"></div>    
<?php    
}
if($_SESSION['is_superadmin'] == '1')
{
?>
<!-- -->
<style>
.widget 
{
    border: 0px solid #CDCDCD;
}
</style>
<link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" /> 



         <form id="validate" name="validate" class="form" method="post" action="">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>Custom Message Details</h6></div>
                        
                        <!-- -->
                        
                            <div style="clear:both;"></div>
                            <div style="height:30px;"></div>
                            <div style="clear:both;"></div>
                            <div class="custom_table">
                                <table style="width:100%">
                                    <tr class="yellow">
                                        <td style="widtj:7%;text-align:left;">Message</td>
                                        <td style="widtj:7%;text-align:left;">SMS Sent</td>
                                    </tr>
                                    <?php
                                    if($smsDetails)
                                    {
                                    $custom= 0;
                                        foreach($smsDetails as $detailsInfo)
                                        {
                                    ?>
                                    <tr>
                                        <td style="widtj:50%;text-align:left;"><?php echo $detailsInfo['message']?></td>
                                        <td style="widtj:50%;text-align:left;"><?php echo $detailsInfo['total_sms']?></td>
                                    </tr>
                                    <?php
                                    $custom = $custom + $detailsInfo['total_sms'];
                                        }
                                    }
                                    else
                                    {
                                    ?>    
                                     <tr>
                                        <td style="width:100%;text-align:center;" colspan="6">No Record Found</td>
                                    </tr>   
                                        
                                    <?php    
                                    }
                                    ?>
                                    <tr>
                                        <td style="widtj:100%;text-align:center;" colspan="6"></td>
                                    </tr>  
                                </table> 
                            </div>
                        
                        
                        <!-- -->
		<div class="title"><h6>Total: <?php echo $total; ?> (Custom = <?php echo $custom; ?>, Result = <?php echo $total-$custom; ?> )</h6></div>
                </div>
             </fieldset> 
           </form>
           <div style="clear:both;"></div>
           <div style="height:30px;"></div>
           <div style="clear:both;"></div>
           

<!-- -->
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>
<?php
}
?>
