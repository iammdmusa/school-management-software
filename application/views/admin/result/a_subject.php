<?php
if($a_subject)
{  
?>
<div class="clear"></div>
<div class="v_gap"></div>
<div class="v_gap"></div>
<div class="clear"></div>
&nbsp;&nbsp;&nbsp;&nbsp;Select any of these exam to make print copy.<br/><br/>
<table style="width:100%;margin-left:15px;">
    <tr>
<?php
    foreach($a_subject as $ira)
    {
?>
        <td>
            <input type="radio" name="print_examselection" value="<?php echo $ira['exam_id']?>" /> <?php echo $ira['exam_name']?>
       </td>

<?php
    }
?>
    </tr>
</table>  
<?php    
}
?>