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
        <td style="widtj:20%;text-align:left;">
            <input id="marks_<?php echo $sInfo['student_result_id']?>" type="text" style="width:80px;" value="<?php echo $sInfo['marks']?>"    name="marks[<?php echo $sInfo['student_result_id']?>]" class="subject_marks" data="<?php echo $sInfo['student_result_id']?>">
        </td>
        <td style="widtj:20%;text-align:left;">
            <select id="grade_id_<?php echo $sInfo['student_result_id']?>" style="width:80px;"  name="grade_id[<?php echo $sInfo['student_result_id']?>]"> 
                <option value="" >Select One</option>
                <option <?php if($sInfo['grade_id'] == 'A+'){ echo 'selected="selected"'; }?> value="A+">A+</option>
                <option <?php if($sInfo['grade_id'] == 'A'){ echo 'selected="selected"'; }?> value="A">A</option>
                <option <?php if($sInfo['grade_id'] == 'A-'){ echo 'selected="selected"'; }?> value="A-">A-</option>
                <option <?php if($sInfo['grade_id'] == 'B+'){ echo 'selected="selected"'; }?> value="B+">B+</option>
                <option <?php if($sInfo['grade_id'] == 'B'){ echo 'selected="selected"'; }?> value="B">B</option>
                <option <?php if($sInfo['grade_id'] == 'C'){ echo 'selected="selected"'; }?> value="C">C</option>
                <option <?php if($sInfo['grade_id'] == 'F'){ echo 'selected="selected"'; }?> value="F">F</option>
            </select> 

        </td>

        <td style="widtj:30%;text-align:left;">
            <input  type="text" style="width:80px;"  value="<?php echo $sInfo['remarks']?>"    name="remarks[<?php echo $sInfo['student_result_id']?>]"  />
        </td>
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
<script type="text/javascript">
    $(".subject_marks").keyup(function() {
        var marks = $(this).val();
        var student_id = $(this).attr('data');
        if(marks>=90 && marks<=100) {
            $("#grade_id_" + student_id).val("A+");
        } else if(marks>=80 && marks<90) {
            $("#grade_id_" + student_id).val("A");
        } else if(marks>=70 && marks<80) {
            $("#grade_id_" + student_id).val("A-");
        } else if(marks>=60 && marks<70) {
            $("#grade_id_" + student_id).val("B+");
        } else if(marks>=50 && marks<60) {
            $("#grade_id_" + student_id).val("B");
        } else if(marks>=40 && marks<50) {
            $("#grade_id_" + student_id).val("C");
        } else {
            $("#grade_id_" + student_id).val("F");
        }
    });
</script> 