<table width="100%" cellpadding="0" cellspacing="0" border="0">
    
    <tr>
        <td colspan="2">
            <img src="<?php echo BASEURL?>images/students/thumb/<?php echo $studentInfo['image']?>" />
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td style="width:120px;">Name</td>
        <td  style="width:320px;"><?php echo $studentInfo['name']?></td>
    </tr>
    <tr>
        <td style="width:120px;">Father's Name</td>
        <td  style="width:320px;"><?php echo $studentInfo['father_name']?></td>
    </tr>
    <tr>
        <td style="width:120px;">Mother's Name</td>
        <td  style="width:320px;"><?php echo $studentInfo['mother_name']?></td>
    </tr>
    <tr>
        <td style="width:120px;">Gurdian's Name</td>
        <td  style="width:320px;"><?php echo $studentInfo['gurdian_name']?></td>
    </tr>
    <tr>
        <td style="width:120px;">Gurdian's Relation</td>
        <td  style="width:320px;"><?php echo $studentInfo['gurdian_relation']?></td>
    </tr>
    <tr>
        <td style="width:120px;">Gurdian's Phon No</td>
        <td  style="width:320px;"><?php echo $studentInfo['gurdian_phon_no']?></td>
    </tr>
    <tr>
        <td style="width:120px;">Student Birth Date</td>
        <td  style="width:320px;"><?php echo date('M D, Y',strtotime($studentInfo['birthdate']));?></td>
    </tr>
</table>