<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function admin_login_check($email,$password)
    {
       $sql = "SELECT * FROM scl_admin WHERE email = '$email' AND password = '$password' AND status = 1 LIMIT 1"; 
       $query = $this->db->query($sql);
       $res = $query->row_array();
       return $res;
    }
    function common_insert($data,$tablename)
    {
        $this->db->insert($tablename, $data); 
        return $this->db->insert_id();
    }
    function common_result_array($tablename)
    {
        $sql = "SELECT * FROM $tablename";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;  
    }
    function common_cond_result_array($tablename,$condition_column,$column_id)
    {
        $sql = "SELECT * FROM $tablename WHERE $condition_column = $column_id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;  
    }
    function common_cond_row_array($tablename,$condition_column,$column_id)
    {
        $sql = "SELECT * FROM $tablename WHERE $condition_column = $column_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        return $res;
    }
    function common_update($tablename,$data,$condition_id,$condition_column_name)
    {
        $this->db->where ($condition_column_name,$condition_id);
        $this->db->update ($tablename,$data );
    }
    function common_delete($tablename,$condition_column_name,$condition_id)
    {
       $sql = "DELETE FROM `$tablename` WHERE `$condition_column_name` = $condition_id"; 
       $this->db->query($sql); 
    }
    function get_school_id($admin_id)
    {
        $sql = "SELECT school_id FROM scl_school WHERE admin_id = $admin_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        return $res['school_id'];  
    }
    function get_school_info()
    {
       $sql = "SELECT * FROM scl_school ORDER BY school_name ASC";
       $query = $this->db->query($sql);
       $res = $query->result_array();
       return $res;    
    }
    function edit_table_data($data,$table_name,$unique_id_name,$unique_id)
    {
        $this->db->where($unique_id_name, $unique_id);
        $this->db->update($table_name, $data);
    }
    function get_school_admin_info()
    {
        $sql = "SELECT a.admin_id,
                       a.email,
                       a.is_superadmin,
                       a.status,
                       a.school_id,
                       s.school_name
                FROM scl_admin a
                INNER JOIN scl_school s ON s.school_id = a.school_id
                WHERE a.is_superadmin = 2
                ORDER BY s.school_name ASC";  
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;   
    }
    function get_one_school_information($school_id)
    {
       $sql = "SELECT s.school_id,
                      s.school_name,
                      s.mail_id,
                      s.phon_no,
                      s.school_short_name,
                      s.billing_information,
                      s.sms_quota,
                      s.school_username,
                      s.admin_id,
                      s.status,
                      s.created_on,
                      s.billing_status,
                      s.current_billing_year,
                      si.logo,
                      sa.admin_id,
                      sa.email,
                      s.sid
               FROM scl_school s
               INNER JOIN scl_admin sa ON sa.admin_id = s.admin_id
               LEFT JOIN  scl_school_logo si ON si.school_id = s.school_id
               WHERE s.school_id = $school_id LIMIT 1";
       $query = $this->db->query($sql);
       $res = $query->row_array();
       return $res;    
    }
    function get_section_info($school_id)
    {
       $sql = "SELECT * FROM scl_section WHERE school_id = $school_id ORDER BY section ASC"; 
       $query = $this->db->query($sql);
       $res = $query->result_array();
       return $res;   
    }
    function get_teacher_list($school_id)
    {
       $sql = "SELECT * FROM scl_teacher WHERE school_id = $school_id ORDER BY name ASC"; 
       $query = $this->db->query($sql);
       $res = $query->result_array();
       return $res;   
    }
    function get_class_list($school_id)
    {
       $sql = "SELECT cn.class_name_id,
                      cn.classname,
                      c.school_id
               FROM scl_class_name cn
               INNER JOIN scl_class c ON c.class_name_id = cn.class_name_id
               WHERE c.school_id = $school_id ORDER BY cn.classname ASC"; 
       $query = $this->db->query($sql);
       $res = $query->result_array();
       return $res;   
    }
    
    function get_class_name_info()
    {
       $sql = "SELECT * FROM scl_class_name ORDER BY class_name_id ASC"; 
       $query = $this->db->query($sql);
       $res = $query->result_array();
       return $res;   
    }
    function get_sectionInfo($school_id,$class_name_id)
    {
        $sql = "SELECT DISTINCT section_id FROM scl_class WHERE status = 1 AND school_id = $school_id AND class_name_id = $class_name_id"; 
        $query = $this->db->query($sql);
        $res = $query->result_array();
        
        if($res)
        {
           foreach($res as $r)
           {
              $arr[] = $r['section_id'];
           }
           if($arr)
           {
               $comma_seperated_ids = implode(',',$arr);
               $sql = "SELECT * FROM scl_section WHERE section_id IN($comma_seperated_ids)";
               $query = $this->db->query($sql);
               $res = $query->result_array();
               
               if($res)
               {
                   $str = '<option value="" >Select One</option>';
                   foreach($res as $r)
                   {
                      $str .= '<option value="'.$r['section_id'].'" >'.$r['section'].'</option>'; 
                   }
                   return $str;   
               }
           }
        } 
        return '';   
    }
    function get_subject_info($school_id,$class_name_id,$section_id)
    {
        $sql = "SELECT * FROM scl_class WHERE status = 1 AND school_id = $school_id AND class_name_id = $class_name_id AND section_id = $section_id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        
        $str = '';
        if($res)
        {
           $str = '<option value="" >Select One</option>'; 
           foreach($res as $r)
           {
              $str .= '<option value="'.$r['class_id'].'" >'.$r['subject'].'</option>'; 
           }
           return $str;  
        }
        return '';
    }
    function class_subject_ajax($school_id,$class_name_id)
    {
        $sql = "SELECT * FROM scl_class WHERE status = 1 AND school_id = $school_id AND class_name_id = $class_name_id GROUP BY subject";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        
        $str = '';
        if($res)
        {
           $str = '<option value="" >Select One</option>'; 
           foreach($res as $r)
           {
              $str .= '<option value="'.$r['class_id'].'" >'.$r['subject'].'</option>'; 
           }
           return $str;  
        }
        return '';
    }
    function student_list_ajax($school_id,$class_name_id)
    {
        $sql = "SELECT s.student_id,
                       s.name,
                       s.gurdian_name,
                       s.gurdian_phon_no,
                       s.roll_no,
                       s.school_id,
                       s.status,
                       s.section_id,
                       sc.section
                FROM scl_student s
                INNER JOIN  scl_section sc ON sc.section_id = s.section_id
                WHERE s.school_id = $school_id
                AND s.class_name_id = $class_name_id"; 
         $query = $this->db->query($sql);
         $res = $query->result_array();       
         return $res;
    }
    function get_student_detail($student_id,$school_id)
    {
        $sql = "SELECT * FROM scl_student WHERE student_id = $student_id AND school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        return $res; 
    }
    function get_student_result_detail($student_id,$school_id)
    {
         $sql = "SELECT * FROM scl_student_result WHERE student_id = $student_id AND school_id = $school_id";
         
         $query = $this->db->query($sql);
         $res = $query->result_array();       
         return $res;
    }

    function get_distinct_class($school_id)
    {
       $sql = "SELECT DISTINCT class_name_id FROM scl_class WHERE status = 1 AND school_id = $school_id"; 
       $query = $this->db->query($sql);
       $res = $query->result_array();
       
       if($res)
       {
           foreach($res as $r)
           {
              $arr[] = $r['class_name_id'];
           }
           if($arr)
           {
               $comma_seperated_ids = implode(',',$arr);
               $sql = "SELECT * FROM scl_class_name WHERE class_name_id IN($comma_seperated_ids)";
               $query = $this->db->query($sql);
               $res = $query->result_array();
               return $res;
           }
       } 
    }
    function get_student_name($school_id,$class_name_id,$section_id)
    {
        $str = '';
        $sql = "SELECT student_id,
                       name,
                       roll_no
                FROM scl_student
                WHERE class_name_id = $class_name_id
                AND section_id = $section_id
                AND school_id = $school_id
                ORDER BY name ASC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
               
        if($res)
        {
            $str = '<option value="">Select One</option>';
            foreach($res as $r)
            {
               $str .= '<option value="'.$r['student_id'].'">'.$r['name'].' ['.$r['roll_no'].']</option>'; 
            }
            return $str;
        }
        return '<option value="">Select One</option>';
    }
    function get_student_all_information($condition = '')
    {
       $sql = "SELECT scl_student.student_id,
                      scl_student.name,
                      scl_student.father_name,
                      scl_student.mother_name,
                      scl_student.gurdian_name,
                      scl_student.gurdian_relation,
                      scl_student.gurdian_phon_no,
                      scl_student.class_name_id,
                      scl_student.section_id,
                      scl_student.roll_no,
                      scl_student.created_on,
                      scl_student.school_id,
                      scl_section.section,
                      scl_school.school_name,
                      scl_school.mail_id as school_mail_id,
                      scl_school.phon_no,
                      scl_school.sid,
                      scl_school.sms_quota
       FROM  scl_student 
       INNER JOIN  scl_section ON scl_section.section_id = scl_student.section_id 
       INNER JOIN  scl_school ON scl_school.school_id = scl_student.school_id 
       WHERE scl_student.status = 1 $condition"; 
       $query = $this->db->query($sql);
       $res = $query->result_array(); 
       return $res;
    }
    function get_school_information()
    {
        $sql = "SELECT school_id,school_name FROM scl_school WHERE status = 1";   
        $query = $this->db->query($sql);
        $res = $query->result_array(); 
        return $res;
    }
    function get_student_name_all($school_id,$class_name_id)
    {
        $str = '';
        $sql = "SELECT student_id,
                       name,
                       roll_no
                FROM scl_student
                WHERE class_name_id = $class_name_id
                AND school_id = $school_id
                ORDER BY name ASC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
               
        if($res)
        {
            $str = '<option value="">Select One</option>';
            foreach($res as $r)
            {
               $str .= '<option value="'.$r['student_id'].'">'.$r['name'].' ['.$r['roll_no'].']</option>'; 
            }
            return $str;
        }
        return '<option value="">Select One</option>';
    }
    
    function std_list_ajax($school_id,$class_name_id,$section_id)
    {
        $str = '';
        $sql = "SELECT student_id,
                       name,
                       roll_no
                FROM scl_student
                WHERE class_name_id = $class_name_id
                AND section_id = $section_id
                AND school_id = $school_id
                ORDER BY name ASC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }

    
    function result_sheet_ajax($school_id,$class_name_id)
    {
        $str = '';
        $sql = "SELECT student_id,
                       name,
                       roll_no
                FROM scl_student
                WHERE class_name_id = $class_name_id
                AND school_id = $school_id
                ORDER BY name ASC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }
    function get_school_name_by_school_id($school_id)
    {
        $sql = "SELECT school_name FROM scl_school WHERE school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        return $res['school_name'];
    }
    function get_school_teacher_list($school_id)
    {
        $sql = "SELECT t.teacher_id,
                       t.name as teacher_name,
                       tas.teacher_assign_subject_id,
                       tas.class_id,
                       tas.school_id,
                       tas.created_on,
                       tas.class_name_id,
                       tas.section_id,
                       cn.classname,
                       s.section,
                       cs.subject
                FROM  scl_teacher t
                LEFT JOIN scl_teacher_assign_subject tas ON tas.teacher_id = t.teacher_id
                LEFT JOIN scl_class_name cn ON cn.class_name_id = tas.class_name_id
                LEFT JOIN scl_section s ON s.section_id = tas.section_id
                LEFT JOIN scl_class cs ON cs.class_id = tas.class_id
                WHERE t.school_id = $school_id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }
    function get_school_class_subject_list($school_id)
    {
        $sql = "SELECT DISTINCT class_name_id FROM scl_class WHERE school_id = $school_id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        
        if($res)
        {
           foreach($res as $r)
           {
               $idsArr[] = $r['class_name_id'];
           }
           if($idsArr)
           {
              $comma_ids = implode(',',$idsArr);
              $sql = "SELECT c.class_name_id,
                             c.classname,
                             sc.class_id,
                             sc.subject,
                             sc.section_id,
                             s.section,
                             s.school_id
                      FROM scl_class_name c 
                      LEFT JOIN scl_class sc ON sc.class_name_id = c.class_name_id AND sc.school_id = $school_id
                      LEFT JOIN scl_section s ON s.section_id = sc.section_id AND sc.section_id = sc.section_id AND s.school_id = $school_id
                      WHERE c.class_name_id IN($comma_ids)";
              #dumpVar($sql);
              $query = $this->db->query($sql);
              $res = $query->result_array();
              return $res;
           } 
        }
        return '';
    }
    function get_school_section_list($school_id)
    {
       $sql = "SELECT section_id,
                      section
               FROM scl_section
               WHERE school_id = $school_id"; 
       $query = $this->db->query($sql);
       $res = $query->result_array();
       return $res;
    }
    function get_teacher_asigned_class($school_id)
    {
        $admin_id = $_SESSION['admin_id']; 
        $sql = "SELECT attendance_class_name_id FROM scl_admin WHERE admin_id = $admin_id AND school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        if($res)
        {
            $class_name_id = $res['attendance_class_name_id'];
            $sql = "SELECT classname FROM  scl_class_name WHERE class_name_id = $class_name_id LIMIT 1";
            $query = $this->db->query($sql);
            $res = $query->row_array();       
            return $res['classname'];
        }
    }
    function get_student_attendence_by_teacher($school_id)
    {
        $curDate = date('Y-m-d',time());
        $admin_id = $_SESSION['admin_id']; 
        $sql = "SELECT attendance_class_name_id FROM scl_admin WHERE admin_id = $admin_id AND school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        if($res)
        {
            $class_name_id = $res['attendance_class_name_id'];
            #$sql = "SELECT * FROM  scl_attendance WHERE class_name_id = $class_name_id AND school_id = $school_id AND DATE(created_on) = '$curDate' AND status = 1";
            $sql = "SELECT s.student_id,
                   s.name,
                   s.roll_no,
                   s.section_id,
                   sa.attendance_id,
                   sa.is_present,
                   sa.school_id,
                   sa.class_name_id,
                   sa.created_on
            FROM scl_attendance sa
            INNER JOIN scl_student s ON s.student_id = sa.student_id
            WHERE sa.class_name_id = $class_name_id
            AND sa.school_id = $school_id
            AND sa.status = 1
            AND DATE(sa.created_on) = '$curDate'";
            $query = $this->db->query($sql);
            $res = $query->result_array();       
            return $res;
        }
    }
    
    function get_student_attendence_by_teacher2($school_id,$class_name_id)
    {
            $curDate = date('Y-m-d',time());

            $sql = "SELECT s.student_id,
                   s.name,
                   s.roll_no,
                   s.section_id,
                   sa.attendance_id,
                   sa.is_present,
                   sa.school_id,
                   sa.class_name_id,
                   sa.created_on
            FROM scl_attendance sa
            INNER JOIN scl_student s ON s.student_id = sa.student_id
            WHERE sa.class_name_id = $class_name_id
            AND sa.school_id = $school_id
            AND sa.status = 1
            AND DATE(sa.created_on) = '$curDate'";
            $query = $this->db->query($sql);
            $res = $query->result_array();       
            return $res;
    }
    
    
    function get_student_attendence_by_teacher21($school_id,$class_name_id,$section_id)
    {
            $curDate = date('Y-m-d',time());

            $sql = "SELECT s.student_id,
                   s.name,
                   s.roll_no,
                   s.section_id,
                   sa.attendance_id,
                   sa.is_present,
                   sa.school_id,
                   sa.class_name_id,
                   sa.created_on
            FROM scl_attendance sa
            INNER JOIN scl_student s ON s.student_id = sa.student_id
            WHERE sa.class_name_id = $class_name_id
            AND sa.school_id = $school_id
            AND s.section_id = $section_id
            AND sa.status = 1
            AND DATE(sa.created_on) = '$curDate'";
            $query = $this->db->query($sql);
            $res = $query->result_array();       
            return $res;
            
            $query = $this->db->query($sql);
            $res = $query->result_array();       
            return $res;
    }
    
    
    function get_student_attendence_by_teacher3($school_id,$class_name_id,$section_id)
    {
            $curDate = date('Y-m-d',time());

            $sql = "SELECT s.student_id,
                   s.name,
                   s.roll_no,
                   s.section_id,
                   sa.attendance_id,
                   sa.is_present,
                   sa.school_id,
                   sa.class_name_id,
                   sa.created_on
            FROM scl_attendance sa
            INNER JOIN scl_student s ON s.student_id = sa.student_id
            WHERE sa.class_name_id = $class_name_id
            AND sa.school_id = $school_id
            AND s.section_id = $section_id
            AND sa.status = 1
            AND DATE(sa.created_on) = '$curDate'";

            $query = $this->db->query($sql);
            $res = $query->result_array();       
            return $res;
    }
    
    function get_student_attendence_by_teacher1($school_id,$class_name_id,$section_id)
    {
            $curDate = date('Y-m-d',time());

            $sql = "SELECT s.student_id,
                   s.name,
                   s.roll_no,
                   s.section_id,
                   sa.attendance_id,
                   sa.is_present,
                   sa.school_id,
                   sa.class_name_id,
                   sa.created_on
            FROM scl_attendance sa
            INNER JOIN scl_student s ON s.student_id = sa.student_id
            WHERE sa.class_name_id = $class_name_id
            AND sa.school_id = $school_id
            AND s.section_id = $section_id
            AND sa.status = 1
            AND DATE(sa.created_on) = '$curDate'";
            $query = $this->db->query($sql);
            $res = $query->result_array();       
            return $res;
    }
    
    
    function get_all_student_list($school_id)
    {
        $admin_id = $_SESSION['admin_id']; 
        $sql = "SELECT attendance_class_name_id FROM scl_admin WHERE admin_id = $admin_id AND school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        if($res)
        {
            $class_name_id = $res['attendance_class_name_id'];
            $str = '';
            $sql = "SELECT student_id,
                           name,
                           roll_no,
                           section_id
                    FROM scl_student
                    WHERE class_name_id = $class_name_id
                    AND school_id = $school_id
                    AND status = 1
                    ORDER BY roll_no ASC";
            $query = $this->db->query($sql);
            $res = $query->result_array();
            return $res;
        }
    }
    
    function get_all_student_list2($school_id,$class_name_id)
    {
        $str = '';
        $sql = "SELECT student_id,
                       name,
                       roll_no,
                       section_id
                FROM scl_student
                WHERE class_name_id = $class_name_id
                AND school_id = $school_id
                AND status = 1
                ORDER BY roll_no ASC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }
    function get_all_student_list21($school_id,$class_name_id,$section_id)
    {
        $str = '';
        $sql = "SELECT student_id,
                       name,
                       roll_no,
                       section_id
                FROM scl_student
                WHERE class_name_id = $class_name_id
                AND school_id = $school_id
                AND section_id = $section_id
                AND status = 1
                ORDER BY roll_no ASC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }
    
    function get_all_student_list3($school_id,$class_name_id,$section_id)
    {
        $str = '';
        $sql = "SELECT student_id,
                       name,
                       roll_no,
                       section_id
                FROM scl_student
                WHERE class_name_id = $class_name_id
                AND school_id = $school_id
                AND section_id = $section_id
                AND status = 1
                ORDER BY roll_no ASC";
                
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }
    
    function get_all_student_list1($school_id,$class_name_id,$section_id)
    {
        $str = '';
        $sql = "SELECT student_id,
                       name,
                       roll_no,
                       section_id
                FROM scl_student
                WHERE class_name_id = $class_name_id
                AND school_id = $school_id
                AND section_id = $section_id
                AND status = 1
                ORDER BY roll_no ASC";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;
    }
    
    function teacher_assigned_class_list($school_id,$admin_id)
    {
        $sql = "SELECT attendance_class_name_id FROM scl_admin WHERE admin_id = $admin_id AND school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        if($res)
        {
            $class_name_ids = $res['attendance_class_name_id'];
            $sql = "SELECT * FROM scl_class_name WHERE class_name_id IN ($class_name_ids) ORDER BY class_name_id ASC";
            $query = $this->db->query($sql);
            $res = $query->result_array();
            return $res;
        }
        return ''; 
    }
    
    function teacher_assigned_class_list12($school_id,$admin_id)
    {
        $sql = "SELECT a.teacher_allowed_attendence_id,
                       s.section,
                       cls.classname,
                       a.class_name_id,
                       a.section_id
                FROM scl_teacher_allowed_attendence a
                INNER JOIN scl_section s ON s.section_id = a.section_id
                INNER JOIN  scl_class_name cls ON cls.class_name_id = a.class_name_id
                WHERE a.school_id = $school_id 
                AND a.admin_id = $admin_id";
                
        $query = $this->db->query($sql);
        $res = $query->result_array();
        return $res;  
    }
    
    function get_teacher_class_name_id($school_id)
    {
        $admin_id = $_SESSION['admin_id']; 
        $sql = "SELECT attendance_class_name_id FROM scl_admin WHERE admin_id = $admin_id AND school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        return $res['attendance_class_name_id'];
    }
    
    function get_student_sms_info($school_id,$class_name_id,$curDate,$section_id = 0)
    {
        if($section_id>0)
        {
            $con = "AND s.section_id = $section_id";
        }
        
        $sql = "SELECT s.student_id,
               s.name,
               s.roll_no,
               s.section_id,
               s.gurdian_name,
               s.gurdian_phon_no,
               sa.attendance_id,
               sa.is_present,
               sa.school_id,
               sa.class_name_id,
               sa.created_on,
               scl.school_name,
               scl.sid,
               scl.school_short_name
        FROM scl_attendance sa
        INNER JOIN scl_student s ON s.student_id = sa.student_id
        INNER JOIN scl_school scl ON scl.school_id = s.school_id
        WHERE sa.class_name_id = $class_name_id
        AND sa.school_id = $school_id
        $con
        AND sa.status = 1
        AND DATE(sa.created_on) = '$curDate'";
        $query = $this->db->query($sql);
        $res = $query->result_array();       
        return $res;
    }
    
    function get_teacher_attendence_subject($school_id)
    {
       $sql = "SELECT DISTINCT cn.class_name_id,
                      cn.classname,
                      c.section_id,
                      s.section
               FROM scl_class_name cn
               INNER JOIN scl_class c ON c.class_name_id = cn.class_name_id
               INNER JOIN scl_section s ON s.section_id = c.section_id
               WHERE c.school_id = $school_id"; 
        $query = $this->db->query($sql);
        $res = $query->result_array();       
        return $res;
    }
    ########################################################
    function get_sms($school_id)
    {
       $sql = "SELECT * FROM scl_sms WHERE status = 1 AND school_id = $school_id  LIMIT 1"; 
       $query = $this->db->query($sql);
       $res = $query->row_array();       
       return $res;
    }
}
?>