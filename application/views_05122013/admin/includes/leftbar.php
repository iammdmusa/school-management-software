<!-- Left side content -->
<div id="leftSide">
    <div class="logo">
        <a href="<?php echo BASEURL?>admin">
            <?
            if($_SESSION['is_superadmin'] == '0'|| $_SESSION['is_superadmin'] == '2' || $_SESSION['is_superadmin'] == '3')
            {
                $school_id = $_SESSION['school_id'];
                $sql = "SELECT  * FROM scl_school_logo WHERE school_id = $school_id LIMIT 1";
                $query = $this->db->query($sql);
                $imgres = $query->row_array();
                if($imgres)
                {
            ?>
                    <img src="<?php echo BASEURL?>images/logo/thumb/<?php echo $imgres['logo']?>" width="136" height="81" alt="" />  
            <?
                }
                else
                {
            ?>
                    <img src="<?php echo BASEURL?>admin-img-css-js/images/logo.png" alt="" />
            <?            
                }
            }
            else
            {
            ?>
                <img src="<?php echo BASEURL?>admin-img-css-js/images/logo.png" alt="" />
            <?
            }
            ?>
        
        </a></div>
    <!-- Left navigation -->
    <ul id="menu" class="nav">
        <?
        if($_SESSION['is_superadmin'] == '1')
        {
        ?>
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>School</span></a>
            <ul class="sub">
                <li><a href="<?php echo BASEURL?>create/school" title="">Create School</a></li>                
                <li><a href="<?php echo BASEURL?>create/schooladmin" title="">Create School Admin</a></li>                
            </ul>
        </li>
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>SMS</span></a>
            <ul class="sub">
                <li><a href="<?php echo BASEURL?>create/sms" title="">Create SMS</a></li>                                
            </ul>
        </li>
        <?php
        }
        ?>
        
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>Greeting</span></a>
            <ul class="sub">
                <?
                if($_SESSION['is_superadmin'] == '1')
                {
                ?>
                    <li><a href="<?php echo BASEURL?>create/greeting" title="">Create Greeting</a></li>
                <?php
                }
                ?>                                
                <li><a href="<?php echo BASEURL?>create/greeting_list" title="">Greeting List</a></li>                                
            </ul>
        </li>
        
        <?php
        if($_SESSION['is_superadmin'] == '0'|| $_SESSION['is_superadmin'] == '2')
        {
        ?>
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>Teacher</span></a>
            <ul class="sub">
                
                <?
                if($_SESSION['is_superadmin'] == '2')
                {
                ?>
                <li><a href="<?php echo BASEURL?>create/teacher" title="">Create Teacher</a></li>
                
                <?
                }
                ?> 
                <li><a href="<?php echo BASEURL?>create/assignsubject" title="">Assign Teacher Subject</a></li>
                <li><a href="<?php echo BASEURL?>create/teacherlist" title="">Teacher List</a></li>
                <li><a href="<?php echo BASEURL?>create/teachersms" title="">Teacher SMS</a></li>
            </ul>
        </li>
        
        
        
        
        
        
       
                
                
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>Class</span></a>
            <ul class="sub">
                <?
                if($_SESSION['is_school_admin'] == '1')
                {
                ?>
                <li><a href="<?php echo BASEURL?>create/newclass" title="">Create Class</a></li>
                <li><a href="<?php echo BASEURL?>create/section" title="">Create Section</a></li>
                <?
                }
                ?> 
                <li><a href="<?php echo BASEURL?>create/class_subject_list" title="">Class Subject List</a></li>
                
                <!--li><a href="<?php echo BASEURL?>create/section_list" title="">Section List</a></li-->
            </ul>
        </li>
       
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>Student</span></a>
            <ul class="sub">
               <?
                if($_SESSION['is_school_admin'] == '1')
                {
                ?>
               <li><a href="<?php echo BASEURL?>create/student" title="">Create Student</a></li>
               <li><a href="<?php echo BASEURL?>create/student_list" title="">Student List</a></li>
               <?
                }
                ?>
               <li><a href="<?php echo BASEURL?>create/attendance" title="">Create Student Attendance</a></li>
            </ul>
        </li>
        
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>Result</span></a>
            <ul class="sub">
               <li><a href="<?php echo BASEURL?>create/result" title="">Create Result</a></li>
               <!--li><a href="<?php echo BASEURL?>create/resultlist" title="">Result List</a></li-->
               <li><a href="<?php echo BASEURL?>create/student_result" title="">View Result</a></li>
            </ul>
        </li>
        
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>Exam</span></a>
            <ul class="sub">
               <li><a href="<?php echo BASEURL?>create/exam" title="">Create Exam</a></li>
               <li><a href="javascript:void(0);" title="">Exam List</a></li>
            </ul>
        </li>
        
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>REPORT</span></a>
            <ul class="sub">
               <li><a href="<?php echo BASEURL?>create/student_info" title="">Student Info</a></li>
            </ul>
        </li>
        
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>Message</span></a>
            <ul class="sub">
               <li><a href="<?php echo BASEURL?>create/custom_message" title="">Send Custom Message</a></li>
               <!--li><a href="<?php echo BASEURL?>create/national_holiday" title="">National Holiday</a></li-->
            </ul>
        </li>
        <?
        }
        ?>
        
        
        <?
        if($_SESSION['is_superadmin'] == '3')
        {
        ?>
        <li class="forms"><a href="javascript:void(0);" title="" class="exp"><span>Student Attendence</span></a>
            <ul class="sub">
               <li><a href="<?php echo BASEURL?>create/student_attendence" title="">Attendence</a></li>               
            </ul>
        </li>
        <?
        }
        ?>
    </ul>
</div>