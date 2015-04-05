<?php
#$class_name_id = 4;
$school_id     = $_SESSION['school_id']; 
$sql = "SELECT class_id,subject FROM scl_class WHERE class_name_id = $class_name_id AND school_id = $school_id GROUP BY subject  ORDER BY class_id ASC";
$query = $this->db->query($sql);
$classSubjectInfo = $query->result_array();

$sql = "SELECT student_id,name,roll_no FROM scl_student WHERE school_id = $school_id AND class_name_id = $class_name_id ORDER BY roll_no ASC";
$query = $this->db->query($sql);
$studentInfo = $query->result_array();
?>

<table style="width:100%">
<tr class="yellow" style="font-size:10px;">
    <td style="widtj:10%;text-align:left;">Name</td>
    <td style="widtj:6%;text-align:left;">Roll No.</td>
    <?php
    if($classSubjectInfo)
    {
        foreach($classSubjectInfo as $csi)
        {  
    ?>
        <td style="widtj:7%;text-align:left;"><?php echo $csi['subject']?></td>
    <?php
        }
     }
    ?>
</tr>
<?php
if($studentInfo)
{
    foreach($studentInfo as $sinf)
    {  
        $student_id = $sinf['student_id']; 
?>
<tr>
    <td style="widtj:10%;text-align:left;"><a href="javascript:void(0);" onclick="get_student_profile(<?php echo $sinf['student_id']?>);"><?php echo $sinf['name']?></a></td>
    <td style="widtj:6%;text-align:left;"><?php echo $sinf['roll_no']?></td>
    <?php
    $td = 0;
    if($classSubjectInfo)
    {
        foreach($classSubjectInfo as $csi)
        {  
            $td++;
            $class_id = $csi['class_id'];
            $sql = "SELECT marks,grade_id FROM scl_student_result WHERE class_name_id = $class_name_id AND student_id = $student_id AND school_id = $school_id  AND class_id = $class_id LIMIT 1";
            $query = $this->db->query($sql);
            $res = $query->row_array();
    ?>
            <td style="widtj:7%;text-align:left;"><?php echo $res['marks']?></td>
    <?php
        }
     }
    ?>
</tr>
<?php
    }
 }
 else
 {  
    $td = $td>0?$td:1;  
?>
<tr>
   <td style="text-align:left;" colspan="<?php echo $td+2?>">No Record Found</td>
</tr>
<?php
 }
?>
</table>