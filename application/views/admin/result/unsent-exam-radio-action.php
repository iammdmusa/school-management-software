<?php
if($usrAction)
{  
?>
&nbsp;&nbsp;&nbsp;&nbsp;Select any of these exam to send message.<br/><br/>
<table style="width:100%;margin-left:15px;">
    <tr>
<?php
    foreach($usrAction as $ira)
    {
?>
        <td>
            <input type="radio" name="examselection" value="<?php echo $ira['exam_id']?>" /> <?php echo $ira['exam_name']?>
       </td>

<?php
    }
?>
    </tr>
</table>  
<?php    
}
?>