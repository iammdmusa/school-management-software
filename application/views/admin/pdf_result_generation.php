<?php
if($result)
{
?>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
        <?php
        if($result[0]['std_image'])
        {
        ?>
            <img src="<?php echo BASEURL;?>images/students/small/<?php echo $result[0]['std_image'];?>" />
        <?php
        }
        ?>
        </td>
        <td>Transcript<br/><?php echo $result[0]['school_name']?></td>
    </tr>
    <tr>
        <td>
            <table>
                <tr><td>Student&nbsp;&nbsp;</td><td><?php echo $result[0]['name']?></td></tr>
                <tr><td>Gender&nbsp;&nbsp;</td><td><?php echo $result[0]['gender']?></td></tr>
                <tr><td>Birth Date &nbsp;&nbsp;</td><td><?php echo date('Y-m-d',  strtotime($result[0]['birthdate']))?></td></tr>
            </table>
        </td>
        <td>
            <table>
                <tr><td>Address:<br/><?php echo $result[0]['homeaddress']?></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="background:blue;color:#ffffff;">Subject</td>
        <td style="background:blue;color:#ffffff;">Magks</td>
        <td style="background:blue;color:#ffffff;">Grade</td>
        <td style="background:blue;color:#ffffff;">Remark</td>
    </tr>
    <?php 
    $tmarks = 0;
    $i = 0;
    foreach($result as $r)
    {
    ?>
    <tr>
        <td><?php echo $r['subject']?></td>
        <td><?php echo $r['marks']?></td>
        <td><?php echo $r['grade_id']?></td>
        <td><?php echo $r['remarks']?></td>
    </tr>
    <?php 
    $tmarks = $tmarks + $r['marks'];
    $i++;
    }
    $average = round(($tmarks/$i),2);
    ?>    
    <tr>
        <td style="background:blue;color:#ffffff;">Average</td>
        <td style="background:blue;color:#ffffff;"><?php echo $average;?></td>
        <td style="background:blue;color:#ffffff;" colspan="2">***</td>
    </tr>
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr>
        <td colspan="3">
            <input type="button" id="printBtn" name="printBtn" value="Print" onclick="printpage(); return false;" />
        </td>
    </tr>
</table>
<?php
}
?>
<script>
function printpage()
{
    window.print();
}
</script>