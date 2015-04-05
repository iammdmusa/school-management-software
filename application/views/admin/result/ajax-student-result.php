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
            <input  type="text" style="width:80px;" id="marks_<?php echo $sInfo['student_id']?>"  name="marks[<?php echo $sInfo['student_id']?>]" class="subject_marks" data="<?php echo $sInfo['student_id']?>">
        </td>
        <td style="widtj:20%;text-align:left;">
            <select style="width:80px;" id="grade_id_<?php echo $sInfo['student_id']?>"  name="grade_id[<?php echo $sInfo['student_id']?>]"> 
                <option value="">Select One</option>
                <option value="A+">A+</option>
                <option value="A">A</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="F">F</option>
            </select> 
                            
        </td>
        
        <td style="widtj:30%;text-align:left;">
            <input  type="text" style="width:80px;" id="remarks_<?php echo $sInfo['student_id']?>"  name="remarks[<?php echo $sInfo['student_id']?>]"  />
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
        } else if(marks>=80 && marks<=89) {
            $("#grade_id_" + student_id).val("A");
        } else if(marks>=70 && marks<=79) {
            $("#grade_id_" + student_id).val("A-");
        } else if(marks>=60 && marks<=69) {
            $("#grade_id_" + student_id).val("B+");
        } else if(marks>=50 && marks<=59) {
            $("#grade_id_" + student_id).val("B");
        } else if(marks>=40 && marks<=49) {
            $("#grade_id_" + student_id).val("C");
        } else {
            $("#grade_id_" + student_id).val("F");
        }
    });
</script>