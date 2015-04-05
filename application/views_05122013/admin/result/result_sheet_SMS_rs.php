<link href="<?php echo BASEURL?>styles/custom_table.css" rel="stylesheet" type="text/css" /> 

<table style="width:100%">
    <tr class="yellow">
        <td style="widtj:20%;text-align:left;">Student Name</td>
        <td style="widtj:10%;text-align:left;">Roll No.</td>
        <td style="widtj:20%;text-align:left;">Marks</td>
        <td style="widtj:20%;text-align:left;">Grade</td>
        <td style="widtj:30%;text-align:left;">Remarks</td>
    </tr>
    <?php
    if($studentInfo)
    {
        foreach($studentInfo as $sInfo)
        {
    ?>
    <tr>
        <td style="widtj:20%;text-align:left;"><a href="javascript:void(0);" onclick="get_student_profile(<?php echo $sInfo['student_id']?>);"><?php echo $sInfo['name']?></a></td>
        <td style="widtj:10%;text-align:left;"><?php echo $sInfo['roll_no']?></td>
        <td style="widtj:20%;text-align:left;"><?php echo $sInfo['marks']?> </td>
        <td style="widtj:20%;text-align:left;"><?php echo $sInfo['grade_id']?></td>
        <td style="widtj:30%;text-align:left;"><?php echo $sInfo['remarks']?></td>
    </tr>
    <?php
        }
    }
    else
    {
    ?>    
     <tr>
        <td style="width:100%;text-align:center;" colspan="5">No Record Found</td>
    </tr>   
        
    <?php    
    }
    ?>
    <tr>
        <td style="widtj:100%;text-align:center;" colspan="5"></td>
    </tr>  
</table> 