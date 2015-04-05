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
    $sql = "SELECT student_id FROM scl_student WHERE school_id = $school_id AND class_name_id = $class_name_id AND section_id = $section_id ORDER BY roll_no ASC";
    $query = $this->db->query($sql);
    $res = $query->result_array();
                
    if($res)
    {
    ?>
    <tr class="pcompromise">
          <td>
              
               <?php                
                foreach($res as $r)
                {    
                    $sql = "SELECT name FROM scl_student WHERE student_id = {$r['student_id']}";
                    $query = $this->db->query($sql);
                    $sNameArr = $query->row_array();
                ?>
                <div class="sdtname">
                    <p align="left" class="ttllpadding"><?php echo $sNameArr['name']?></p>
                </div>

                <div class="resultbox">
                    <div class="resmarkbox">
                      <p align="center">80</p>
                    </div>

                    <div class="resgrdkbox">
                      <p align="center">A</p>
                    </div>                                            
                </div>
              <div class="resultbox">
                    <div class="resmarkbox">
                      <p align="center">80</p>
                    </div>

                    <div class="resgrdkbox">
                      <p align="center">A</p>
                    </div>                                            
                </div>
              <?php
                 }              
              ?>
          </td>
      </tr>
      <?php
      }
      ?>

<!--  
    <tr class="pcompromise">
        <td>
            <div class="sdtname evn">
                <p align="left" class="ttllpadding">Md.Hamim</p>
            </div>

            <div class="resultbox">
                <div class="resmarkbox evn">
                  <p align="center">80</p>
                </div>

                <div class="resgrdkbox">
                  <p align="center">A</p>
                </div>                                            
            </div>
            <div class="resultbox">
                <div class="resmarkbox evn">
                  80
                </div>

                <div class="resgrdkbox">
                  A
                </div>                                            
            </div>
            <div class="resultbox">
                <div class="resmarkbox evn">
                  80
                </div>

                <div class="resgrdkbox">
                  A
                </div>                                            
            </div>
            <div class="resultbox">
                <div class="resmarkbox evn">
                  80
                </div>

                <div class="resgrdkbox">
                  A
                </div>                                            
            </div>
            <div class="resultbox">
                <div class="resmarkbox evn">
                  80
                </div>

                <div class="resgrdkbox">
                  A
                </div>                                            
            </div>
        </td>
    </tr>-->
</table>