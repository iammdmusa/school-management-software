<?php
if($attendence)
{
?>
    <input type="hidden" id="is_update" name="is_update" value="1" />
    <input type="hidden" id="send_sms" name="send_sms" value="0" />
    <table style="width:100%">
        <tr class="yellow">
            <td style="widtj:50%;text-align:left;">Student Name</td>
            <td style="widtj:35%;text-align:left;">Roll No.</td>
            <td style="widtj:15%;text-align:left;">Is Present ?</td>
        </tr>
        <?php
        if($attendence)
        {
            foreach($attendence as $sInfo)
            {
        ?>
        <tr>
            <td style="widtj:50%;text-align:left;"><?php echo $sInfo['name']?></td>
            <td style="widtj:35%;text-align:left;"><?php echo $sInfo['roll_no']?></td>
            <td style="widtj:15%;text-align:left;">
                <input type="hidden"  id="is_present_hid<?php echo $sInfo['student_id']?>"  name="is_present_hid[<?php echo $sInfo['student_id']?>]" value="1" />
                <input type="checkbox" <?php if($sInfo['is_present'] == '1'){ echo 'checked="checked"'; } ?> id="is_present_<?php echo $sInfo['student_id']?>"  name="is_present[<?php echo $sInfo['student_id']?>]" value="1" />
                <input type="hidden" id="section_id_<?php echo $sInfo['student_id']?>"  name="section_id[<?php echo $sInfo['student_id']?>]"  value="<?php echo $sInfo['section_id']?>" />
            </td>
        </tr>
        <?php
            }
        }
        else
        {
        ?>    
         <tr>
            <td style="widtj:100%;text-align:center;" colspan="3">No Record Found</td>
        </tr>   
            
        <?php    
        }
        ?>
    </table>
<?php
}
else if($studentList)
{
?>
<table style="width:100%">
    <tr class="yellow">
        <td style="widtj:50%;text-align:left;">Student Name</td>
        <td style="widtj:25%;text-align:left;">Roll No.</td>
        <td style="widtj:15%;text-align:left;">Is Present ?</td>
        <td style="widtj:10%;text-align:left;">Date</td>
    </tr>
    <?php
    if($studentList)
    {
        foreach($studentList as $sInfo)
        {
    ?>
    <tr>
        <td style="widtj:50%;text-align:left;"><?php echo $sInfo['name']?></td>
        <td style="widtj:25%;text-align:left;"><?php echo $sInfo['roll_no']?></td>
        <td style="widtj:15%;text-align:left;">
            <input type="hidden"  id="is_present_hid<?php echo $sInfo['student_id']?>"  name="is_present_hid[<?php echo $sInfo['student_id']?>]" value="1" />
            <input type="checkbox" checked="checked" id="is_present_<?php echo $sInfo['student_id']?>"  name="is_present[<?php echo $sInfo['student_id']?>]" value="1" />
            <input type="hidden" id="section_id_<?php echo $sInfo['student_id']?>"  name="section_id[<?php echo $sInfo['student_id']?>]"  value="<?php echo $sInfo['section_id']?>" />
        </td>
        <td style="widtj:10%;text-align:left;"><?php echo date('Y-m-d',time());?></td>
    </tr>
    <?php
        }
    }
    else
    {
    ?>    
     <tr>
        <td style="widtj:100%;text-align:center;" colspan="3">No Record Found</td>
    </tr>   
        
    <?php    
    }
    ?>
</table>
<?php
}
?>