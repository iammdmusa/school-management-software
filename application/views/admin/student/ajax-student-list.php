<link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" /> 

<table style="width:100%">
    <tr class="yellow">
        <td style="widtj:20%;text-align:left;">Student Name</td>
        <td style="widtj:20%;text-align:left;">Section</td>
        <td style="widtj:20%;text-align:left;">Roll No.</td>
        <td style="widtj:20%;text-align:left;">Gurdian Name</td>
        <td style="widtj:10%;text-align:left;">Gurdian Phon No</td>
        <td style="widtj:10%;text-align:right;">Action</td>
    </tr>
    <?php
    if($studentInfo)
    {
        foreach($studentInfo as $sInfo)
        {
    ?>
    <tr>
        <td style="widtj:20%;text-align:left;"><a href="javascript:void(0);" onclick="get_student_profile(<?php echo $sInfo['student_id']?>);"><?php echo $sInfo['name']?></a></td>
        <td style="widtj:20%;text-align:left;"><?php echo $sInfo['section']?></td>
        <td style="widtj:20%;text-align:left;"><?php echo $sInfo['roll_no']?></td>
        <td style="widtj:20%;text-align:left;"><?php echo $sInfo['gurdian_name']?></td>
        <td style="widtj:10%;text-align:left;"><?php echo $sInfo['gurdian_phon_no']?></td>
        <td style="widtj:10%;text-align:right;">
            <a href="javascript:void(0);" onclick="delete_student(<?php echo $sInfo['student_id']?>); return false;">Delete Student</a> |
            <a href="<?php echo BASEURL?>create/edit_student/<?php echo $sInfo['student_id']?>" >Edit</a>
        </td>
    </tr>
    <?php
        }
    }
    else
    {
    ?>    
     <tr>
        <td style="widtj:50%;text-align:center;" colspan="6">No Record Found</td>
    </tr>   
        
    <?php    
    }
    ?>
    
</table> 