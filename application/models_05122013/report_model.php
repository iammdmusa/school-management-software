<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_class_section_list_rs($school_id,$class_name_id)
    {
        $sql = "SELECT DISTINCT section_id FROM scl_class WHERE school_id = $school_id AND class_name_id = $class_name_id AND status = 1";
        $query = $this->db->query($sql);
        $res = $query->result_array(); 
        $str1 = '';
        
        if($res)
        {
           foreach($res as $r)
           {
              $rsArr[] = $r['section_id'];
           }
           $comma_section_ids = implode(',',$rsArr);
           if($comma_section_ids)
           {
               $sql = "SELECT * FROM scl_section WHERE section_id IN ($comma_section_ids) AND status = 1"; 
               $query = $this->db->query($sql);
               $res = $query->result_array(); 
               
               if($res)
               {
                  $str1 .= '<option value="">Select One</option>'; 
                  foreach($res as $rs)
                  {
                     $str1 .= '<option value="'.$rs['section_id'].'">'.$rs['section'].'</option>';
                  } 
               }
               return $str1;
           }
        }
    }
    
    function get_class_subject_list_rs($school_id,$class_name_id,$section_id)
    {
        $sql = "SELECT * FROM scl_class WHERE class_name_id = $class_name_id AND section_id = $section_id AND school_id = $school_id AND status = 1";
        $query = $this->db->query($sql);
        $res = $query->result_array(); 
        $str1 = '';
        
        if($res)
        {
           if($res)
           {
              $str1 .= '<option value="">Select One</option>'; 
              foreach($res as $rs)
              {
                 $str1 .= '<option value="'.$rs['class_id'].'">'.$rs['subject'].'</option>';
              } 
           }
           return $str1;
        }
    }
    
    function get_result_sheet_SMS_rs1($school_id,$section_id,$class_id,$class_name_id)
    {            
        $sql = "SELECT DISTINCT exam_id FROM scl_student_result WHERE class_name_id = $class_name_id AND school_id = $school_id AND section_id = $section_id AND class_id = $class_id";
        $query = $this->db->query($sql);
        $result = $query->result_array(); 
        if($result)
        {
           foreach($result as $rs)
           {
              $rsArr[] = $rs['exam_id']; 
           }
           if($rsArr)
           {
              $comma_seperated_exam_ids = implode(',', $rsArr);
              
              $sql = "SELECT * FROM scl_exam WHERE school_id = $school_id AND status = 1 AND exam_id IN($comma_seperated_exam_ids)";
              $query = $this->db->query($sql);
              $res = $query->result_array(); 
              return $res;
           }
        }
    }
    
    function get_is_sms_sent($school_id,$section_id,$class_id,$class_name_id)
    {
        $sql = "SELECT is_result_sent FROM scl_student_result WHERE class_name_id = $class_name_id AND school_id = $school_id AND section_id = $section_id AND class_id = $class_id LIMIT 1";
        
        //return $sql;   
        
        $query = $this->db->query($sql);
        $result = $query->row_array();         
        if($result['is_result_sent'] == 1)
        {
           $return = '1'; 
        }
        else 
        {
           $return = '0';  
        }
        return $return;
    }
    
    
    function radioaction_list($school_id,$section_id,$class_id,$class_name_id)
    {            
        $sql = "SELECT DISTINCT exam_id FROM scl_student_result WHERE class_name_id = $class_name_id AND school_id = $school_id AND section_id = $section_id AND class_id = $class_id AND is_result_sent = 0";
        $query = $this->db->query($sql);
        $result = $query->result_array(); 
        if($result)
        {
           foreach($result as $rs)
           {
              $rsArr[] = $rs['exam_id']; 
           }
           if($rsArr)
           {
              $comma_seperated_exam_ids = implode(',', $rsArr);
              
              $sql = "SELECT * FROM scl_exam WHERE school_id = $school_id AND status = 1 AND exam_id IN($comma_seperated_exam_ids)";
              $query = $this->db->query($sql);
              $res = $query->result_array(); 
              return $res;
           }
        }
    }
}
?>