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
                    <div class="title"><h6>School List</h6></div>
                        
                        <!-- -->
                        
                            <div style="clear:both;"></div>
                            <div style="height:30px;"></div>
                            <div style="clear:both;"></div>
                            <div class="custom_table">
                                <table style="width:100%">
                                    <tr class="yellow">
                                        <td style="widtj:56%;text-align:left;" nowrap="nowrap">School</td>
                                        <td style="widtj:7%;text-align:left;">Contact No.</td>
                                        <td style="widtj:7%;text-align:left;">Mail ID</td>
                                        <td style="widtj:10%;text-align:left;">Billing Status</td>
                                        <td style="widtj:10%;text-align:left;">Billing Year</td>
                                        <td style="widtj:10%;text-align:left;">Action</td>
                                    </tr>
                                    <?php
                                    if($schoolInfo)
                                    {
                                        foreach($schoolInfo as $sInfo)
                                        {
                                    ?>
                                    <tr>
                                        <td style="widtj:46%;text-align:left;" nowrap="nowrap"><?php echo $sInfo['school_name']?></td>
                                        <td style="widtj:7%;text-align:left;"><?php echo $sInfo['phon_no']?></td>
                                        <td style="widtj:7%;text-align:left;"><?php echo $sInfo['mail_id']?></td>
                                        <td style="widtj:10%;text-align:left;">
                                        <?
                                        if($sInfo['billing_status'] == '1')
                                        {
                                        ?>
                                             Enabled
                                        <?
                                        }
                                        else
                                        {
                                        ?>
                                             Disabled
                                        <?    
                                        }
                                        ?>
                                        </td>
                                        <td style="widtj:10%;text-align:left;"><?php echo $sInfo['current_billing_year']?></td>
                                        <td style="widtj:10%;text-align:left;">
                                            <a href="<?php echo BASEURL?>create/edit_school/<?php echo $sInfo['school_id']?>">Edit</a> |
                                            <a href="javascript:void(0);" onclick="delete_school(<?php echo $sInfo['school_id']?>); return false;">Delete</a> |
                                            <?
                                            if($sInfo['billing_status'] == '1')
                                            {
                                            ?>
                                                 <a title="Make it disabled" href="javascript:void(0);" onclick="enable_disable_school(<?php echo $sInfo['school_id']?>,0); return false;">Disabled</a>
                                            <?
                                            }
                                            else
                                            {
                                            ?>
                                                 <a title="Make it Enable" href="javascript:void(0);" onclick="enable_disable_school(<?php echo $sInfo['school_id']?>,1); return false;">Enabled</a>
                                            <?    
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
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

                </div>
             </fieldset> 
           </form>
           <div style="clear:both;"></div>
           <div style="height:30px;"></div>
           <div style="clear:both;"></div>
           
           <form id="validate" name="validate" class="form" method="post" action="">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>School Data Entry Operator</h6></div>
                        
                    <div style="clear:both;"></div>
                            <div style="height:30px;"></div>
                            <div style="clear:both;"></div>
                            <div class="custom_table">
                                <table style="width:100%">
                                    <tr class="yellow">
                                        <td style="widtj:60%;text-align:left;" nowrap="nowrap">School</td>
                                        <td style="widtj:7%;text-align:left;">Email</td>
                                        <td style="widtj:10%;text-align:left;">Action</td>
                                    </tr>
                                    <?
                                    if($sadminInfo)
                                    {
                                        foreach($sadminInfo as $saInfo)
                                        {
                                    ?>
                                    <tr>
                                        <td style="widtj:60%;text-align:left;" nowrap="nowrap"><?php echo $saInfo['school_name']?></td>
                                        <td style="widtj:7%;text-align:left;"><?php echo $saInfo['email']?></td>
                                        <td style="widtj:10%;text-align:left;">
                                           <a href="javascript:void(0);" onclick="delete_school_admin(<?php echo $saInfo['admin_id']?>); return false;">Delete</a>
                                        </td>
                                    </tr>     
                                    <?
                                        }
                                    }
                                    ?>
                               </table>
                </div>
             </fieldset> 
           </form>

	 <div style="clear:both;"></div>
         <div style="height:30px;"></div>
         <div style="clear:both;"></div>
        <form id="validate" name="validate" class="form" method="post" action="">
            <fieldset>
                <div class="widget">
                    <div class="title"><h6>SMS Statistics</h6></div>
                        
                    <div style="clear:both;"></div>
                            <div style="height:30px;"></div>
                            <div style="clear:both;"></div>
                            <div class="custom_table">
                                <table style="width:100%">
                                    <tr class="yellow">
                                        <td style="widtj:60%;text-align:left;" nowrap="nowrap">School</td>
                                        <td style="widtj:7%;text-align:left;">Total SMS Sent</td>
                                        <td style="widtj:10%;text-align:left;">Action</td>
                                    </tr>
                                    <?
                                    if($smsInfo)
                                    {
                                        foreach($smsInfo as $msgInfo)
                                        {
                                    ?>
                                    <tr>
                                        <td style="widtj:60%;text-align:left;" nowrap="nowrap"><?php echo $msgInfo['school_name']?></td>
                                        <td style="widtj:7%;text-align:left;"><?php echo $msgInfo['no_of_sms']?></td>
                                        <td style="widtj:10%;text-align:left;">
                                           <a href="<?php echo BASEURL?>report/sms_statistics/<?php echo $msgInfo['school_id']?>">View Details</a>
                                        </td>
                                    </tr>     
                                    <?
                                        }
                                    }
                                    ?>
                               </table>
                </div>
             </fieldset> 
           </form> 
         	

<!-- -->
<script type="text/javascript" src="<?php echo BASEURL?>admin-img-css-js/cmn.js"></script>
<?php
}
?>
