<table> 
    <tr>
        <td>
            <?php
            if($classExam)
            {
            ?>
                <div class="hclass sdtnamettl">
                   <p class="centertxt" align="center">Student name</p>
                </div>
                <?php
                foreach($classExam as $cE)
                {
                    $examName = $cE['exam_name'];
                    $exam_id = $cE['exam_id'];
                    
                    $sql = "SELECT r.exam_date,
                                   e.exam_id,
                                   e.exam_name,
                                   r.section_id,
                                   r.class_name_id
                            FROM scl_student_result r
                            INNER JOIN scl_exam e ON e.exam_id = r.exam_id
                            WHERE r.class_name_id = $class_name_id 
                            AND r.school_id = $school_id 
                            AND r.class_id = $class_id
                            AND r.exam_id = $exam_id
                            LIMIT 1";
                    

                    $query = $this->db->query($sql);
                    $res = $query->row_array(); 
                    

                ?>
                <div class="hclass">
                    <p align="center"><?php echo $examName?></p>
                    <p align="center">
                        (<?php echo $res['exam_name']?>)
                        <br/>
                        <?php echo $res['exam_date']?>
                    </p>
                </div>
                <?php
                }
            }
            ?>

        </td>
    </tr>
    <?php
    $sql = "SELECT student_id,name,roll_no FROM scl_student WHERE school_id = $school_id AND class_name_id = $class_name_id AND section_id = $section_id ORDER BY roll_no ASC";
    $query = $this->db->query($sql);
    $res = $query->result_array();
    
    if($res)
    {
        foreach($res as $r)
        {
           $student_id = $r['student_id']; 
           $roll_no = $r['roll_no']; 
    ?>
    <tr class="pcompromise">
        <td>
            
            <div class="sdtname <?php echo $odd ? 'evn' : ''; ?>">
                <p align="left" class="ttllpadding"><?php echo $r['name']?> [<span style="color:blue;"><?php echo $roll_no?></span>]</p>
            </div>
            <?php
            foreach($classExam as $cE)
            {
                $exam_id = $cE['exam_id'];
                $sql = "SELECT marks,grade_id FROM scl_student_result WHERE student_id = $student_id AND class_name_id = $class_name_id AND section_id = $section_id AND exam_id = $exam_id AND class_id = $class_id LIMIT 1";
                $query = $this->db->query($sql);
                $result = $query->row_array();
            ?>
            <div class="resultbox">
                <div class="resmarkbox <?php echo $odd ? 'evn' : ''; ?>">
                  <p align="center"><?php echo $result['marks']?></p>
                </div>

                <div class="resgrdkbox">
                  <p align="center"><?php echo $result['grade_id']?></p>
                </div>                                            
            </div>
            <?php        
            }
            ?>            
        </td>
    </tr>
    <?php
        $odd = !$odd;   
        }
    }
    ?>
</table>
<div class="clear"></div>
<div class="v_gap"></div>
<div class="clear"></div>