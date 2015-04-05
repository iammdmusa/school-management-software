<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'Admin_model', true); 
        $this->load->library('pagination'); 
        if(!is_admin_loggedin())
        { 
            redirect('admin');exit;
        } 
    }
	public function index()
	{ 
        
	}
    
    function school()
    {
         if($_SESSION['is_superadmin'] != '1') { redirect('admin'); exit; }
         if(isPostBack())
         {
             $scladmin['password']          = md5($_POST['school_password']);
             $scladmin['email']             = $_POST['admin_email'];  
             $scladmin['is_superadmin']     = 0;  
             $scladmin['status']            = 1; 
             $admin_id = $this->Admin_model->common_insert($scladmin,'scl_admin'); 
             
             
             
             $data['school_name']           = $_POST['school_name'];
             $data['mail_id']               = $_POST['mail_id'];
             $data['phon_no']               = $_POST['phon_no'];
             $data['school_short_name']     = $_POST['school_short_name'];
             $data['billing_information']   = $_POST['billing_information'];
             $data['sms_quota']             = $_POST['sms_quota'];
             $data['school_username']       = $_POST['school_username'];
             $data['current_billing_year']  = $_POST['current_billing_year'];
             $data['billing_status']        = $_POST['billing_status'];
             $data['sid']                   = $_POST['sid'];
             $data['admin_id']              = $admin_id;
             $data['status']                = 1;
             $data['created_on']            = date('Y-m-d H:i:s',time());
             
             $school_id = $this->Admin_model->common_insert($data,'scl_school');
             
             if($_POST['images'][0])
             {
                 $sclimg['school_id']   = $school_id;
                 $sclimg['logo']        = $_POST['images'][0]; ;
                 $sclimg['status']      = 1;
                 $school_logo_id = $this->Admin_model->common_insert($sclimg,'scl_school_logo'); 
             }
             
             
             message('School has been added successfully'); 
         }
         
         $data['mainContent'] = $this->load->view('admin/school/create', $data, true); 
         $this->load->view('admin/template', $data);
    }
    function edit_school($school_id)
    {
        if(isPostBack()) 
        {
             if($_POST['school_password'] != '******' && $_POST['school_password'])
             {
                 $scladmin['password']          = md5($_POST['school_password']); 
             } 
             $scladmin['email']             = $_POST['admin_email'];  
             $this->Admin_model->edit_table_data($scladmin,'scl_admin','admin_id',$_POST['admin_id']); 
             
             
             $data['school_name']           = $_POST['school_name'];
             $data['mail_id']               = $_POST['mail_id'];
             $data['phon_no']               = $_POST['phon_no'];
             $data['school_short_name']     = $_POST['school_short_name'];
             $data['billing_information']   = $_POST['billing_information'];
             $data['sms_quota']             = $_POST['sms_quota'];
             $data['school_username']       = $_POST['school_username'];
             $data['current_billing_year']  = $_POST['current_billing_year'];
             $data['billing_status']        = $_POST['billing_status'];
             $data['sid']                   = $_POST['sid'];

             $this->Admin_model->edit_table_data($data,'scl_school','school_id',$_POST['school_id']); 
             
             if($_POST['images'][0])
             {
                 $school_id = $_POST['school_id'];
                 
                 $sql = "DELETE FROM `scl_school_logo` WHERE `school_id` = $school_id";
                 $this->db->query($sql);
                 
                 $sclimg['school_id']   = $school_id;
                 $sclimg['logo']        = $_POST['images'][0]; ;
                 $sclimg['status']      = 1;
                 $this->Admin_model->common_insert($sclimg,'scl_school_logo'); 
             }
             message('School information has been added successdully');
        }
        
        
        
        $data['schoolInfo'] = $this->Admin_model->get_one_school_information($school_id);  
        $data['mainContent'] = $this->load->view('admin/school/edit_school', $data, true); 
        $this->load->view('admin/template', $data);
    }
    function school_billing_status($school_id,$billing_status)
    {
        $sql = "UPDATE `scl_school` SET `billing_status` = '$billing_status' WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "UPDATE `scl_admin` SET `status` = '$billing_status' WHERE `school_id` = $school_id";
        $this->db->query($sql);   
        
        $sql = "SELECT admin_id FROM scl_school WHERE school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);  
        $res = $query->row_array();
        
        $sql = "UPDATE `scl_admin` SET `status` = '$billing_status' WHERE `admin_id` = {$res['admin_id']}";
        $this->db->query($sql); 
        
        message('Billing status has been updated successfully');
        redirect('admin');exit; 
    }
    function delete_school($school_id)
    {
        $sql = "SELECT admin_id FROM scl_school WHERE school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);  
        $res = $query->row_array();
        $admin_id = $res['admin_id'];
        
        $sql = "DELETE FROM `scl_admin` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_admin` WHERE `admin_id` = $admin_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_school` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_class_name` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_class` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_attendance` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_school_logo` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_section` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_student` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_student_result` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_teacher` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        
        $sql = "DELETE FROM `scl_teacher_assign_subject` WHERE `school_id` = $school_id";
        $this->db->query($sql);
        

        message('School has been deleted successfully');
        redirect('admin');exit; 
    }
    
    function delete_school_admin($admin_id)
    {
        $sql = "DELETE FROM `scl_admin` WHERE `admin_id` = $admin_id";
        $this->db->query($sql);
        message('School Admin has been deleted successfully');
        redirect('admin');exit; 
    }
    
    function teacher()
    {
         if(isPostBack())
         {
             /*
             if($_POST['attendance_class_name_id'])
             {
                $comma_seperated_ids = implode(',',$_POST['attendance_class_name_id']) ;
             }
             else
             {
                $comma_seperated_ids = ''; 
             }
             
             dumpVar($_POST['attendance_class_name_id']);
             */
             
             $admin['password']                     = md5($_POST['password']); 
             $admin['is_superadmin']                = 3; 
             $admin['status']                       = 1; 
             $admin['school_id']                    = $_SESSION['school_id']; 
             $admin['created_on']                   = date('Y-m-d H:i:s',time());  
             $admin['email']                        = $_POST['email']; 
             #$admin['attendance_class_name_id']     = $comma_seperated_ids; 
             
             $admin_id = $this->Admin_model->common_insert($admin,'scl_admin');   
             
             
             $data['name']                  = $_POST['name']; 
             $data['subject']               = $_POST['subject']; 
             $data['userid']                = $_POST['userid']; 
             $data['phon_no']               = $_POST['phon_no']; 
             
             $data['status']                = 1;
             $data['created_on']            = date('Y-m-d H:i:s',time());  
             $data['school_id']             = $_SESSION['school_id'];  
             $data['admin_id']              = $admin_id;  
             

             $teacher_id = $this->Admin_model->common_insert($data,'scl_teacher'); 
             
             if(isset($_POST['attendance_class_name_id']) && $_POST['attendance_class_name_id'] != '')
             {
                 foreach($_POST['attendance_class_name_id'] as $key => $value)
                 {
                     $splitArr = explode('-',$value); 
                     
                     $assign['class_name_id']   = $splitArr[0];
                     $assign['section_id']      = $splitArr[1];
                     $assign['admin_id']        = $admin_id;
                     $assign['school_id']       = $_SESSION['school_id'];
                     $assign['status']          = 1;
                     $this->Admin_model->common_insert($assign,'scl_teacher_allowed_attendence');
                 }
             }

             message('Teacher has been added successfully'); 
         }
        $data['atnsubject'] = $this->Admin_model->get_teacher_attendence_subject($_SESSION['school_id']);  
        $data['mainContent'] = $this->load->view('admin/teacher/create', $data, true); 
        $this->load->view('admin/template', $data);
    }
    
    
    
    function newclass()
    {
        if(isPostBack())
         {
             $data['class_name_id']         = $class_name_id = $_POST['class_name_id'];
             $data['school_id']             = $school_id = $_SESSION['school_id']; 
             $data['status']                = 1;
             $data['created_on']            = date('Y-m-d H:i:s',time());    
             
             $sql = "DELETE FROM `scl_class` WHERE `class_name_id` = $class_name_id AND school_id = $school_id";
             $this->db->query($sql);
             
             foreach($_POST['subject'] as $key => $val)
             {
                 $data['subject']  = $val;  
                 if($_POST['section_id'])
                 {
                     foreach($_POST['section_id'] as $k => $value)
                     {
                         if(!$value){continue;}
                         $data['section_id']            = $value;
                         $class_id = $this->Admin_model->common_insert($data,'scl_class'); 
                     }
                 }
             }
             message('Class has been added successfully');  
         }
        
        $data['class'] = $this->Admin_model->get_class_name_info(); 
        $data['section'] = $this->Admin_model->get_section_info($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/newclass/create', $data, true); 
        $this->load->view('admin/template', $data);
    }
    
    function section()
    {
        if(isPostBack())
         {
             $data['section']               = $_POST['section'];  
             $data['status']                = 1;
             $data['created_on']            = date('Y-m-d H:i:s',time());  
             $data['school_id']             = $_SESSION['school_id'];  

             $class_id = $this->Admin_model->common_insert($data,'scl_section'); 
             message('Section has been added successfully'); 
         }
        $data['class'] = $this->Admin_model->get_class_name_info();   
        $data['mainContent'] = $this->load->view('admin/section/create', $data, true); 
        $this->load->view('admin/template', $data);
    }
    
    function assignsubject()
    {
        if(isPostBack())
         {
             $data['teacher_id']               = $_POST['teacher_id']; 
             $data['class_name_id']            = $_POST['class_name_id']; 
             $data['section_id']               = $_POST['section_id']; 
             $data['class_id']                 = $_POST['class_id']; 
             $data['status']                   = 1;
             $data['created_on']               = date('Y-m-d H:i:s',time());  
             $data['school_id']                = $_SESSION['school_id'];  

             $class_id = $this->Admin_model->common_insert($data,'scl_teacher_assign_subject'); 
             message('Class assign has been added successfully'); 
         }
        $data['teacher'] = $this->Admin_model->get_teacher_list($_SESSION['school_id']); 
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/newclass/assignsubject', $data, true); 
        $this->load->view('admin/template', $data);
    }
    function ajax_class_section()
    {
        $class_name_id  = $_GET['class_name_id']; 
        $school_id      = $_SESSION['school_id']; 

        $section_id = $this->Admin_model->get_sectionInfo($_SESSION['school_id'],$class_name_id);  
        $result = 'success';
        $return = array('result' => $result, 'section_id'=> $section_id, 'subject'=> $subject);
        print json_encode($return);
        exit;
    }
    function ajax_class_subject()
    {
        $class_name_id  = $_GET['class_name_id']; 
        $section_id  = $_GET['section_id']; 
        $school_id      = $_SESSION['school_id']; 
 
        $class_id = $this->Admin_model->get_subject_info($_SESSION['school_id'],$class_name_id,$section_id); 
        $result = 'success';
        $return = array('result' => $result, 'class_id'=> $class_id);
        print json_encode($return);
        exit;
    }
    function student()
    {
        if(isPostBack())
        {
             $data['name']                     = $_POST['name']; 
             $data['father_name']              = $_POST['father_name']; 
             $data['mother_name']              = $_POST['mother_name']; 
             $data['gurdian_name']             = $_POST['gurdian_name']; 
             $data['gurdian_relation']         = $_POST['gurdian_relation']; 
             $data['gurdian_phon_no']          = $_POST['gurdian_phon_no']; 
             $data['class_name_id']            = $_POST['class_name_id']; 
             $data['section_id']               = $_POST['section_id'];  
             $data['roll_no']                  = $_POST['roll_no'];  
             $data['birthdate']                = $_POST['birthdate'];  
             $data['image']                    = $_POST['images'][0];  
             $data['status']                   = 1;
             $data['created_on']               = date('Y-m-d H:i:s',time());  
             $data['school_id']                = $_SESSION['school_id'];  

             $student_id = $this->Admin_model->common_insert($data,'scl_student'); 
             message('Student has been added successfully'); 
        } 
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/student/create', $data, true); 
        $this->load->view('admin/template', $data);
    }
    
    function attendance()
    {
        if(isPostBack())
        {
             $data['class_name_id']             = $class_name_id = $_POST['class_name_id']; 
             $data['section_id']                = $section_id = $_POST['section_id'];   
             
             if(isset($_POST['is_update']) && $_POST['is_update'] == '1')
             {
                  $curDate = date('Y-m-d',time()); 
                  $sql = "DELETE FROM `scl_attendance` WHERE `class_name_id` = $class_name_id AND DATE(created_on) = '$curDate' AND section_id = $section_id";   
                  $this->db->query($sql);
             }

             $data['status']                    = 1;
             $data['created_on']                = date('Y-m-d H:i:s',time());  
             $data['school_id']                 = $_SESSION['school_id'];  
             
             $strArr = $_POST['is_present_hid'];
             $strArrdat = $_POST['is_present'];
             if($strArr)
             {
                foreach($strArr as $key => $value)
                {
                   $data['student_id'] = $key;  
                   $data['is_present'] = ($strArrdat[$key] == '1') ? '1':'0';
                   $this->Admin_model->common_insert($data,'scl_attendance'); 
                } 
             }
             message('Attendance_id has been added successfully'); 
        } 
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/student/attendance', $data, true); 
        $this->load->view('admin/template', $data);
    }
    function result()
    {
       if(isPostBack())
       {
             $data['class_name_id']             = $class_name_id = $_POST['class_name_id']; 
             $data['class_id']                  = $class_id = $_POST['class_id']; 
             $data['status']                    = 1;
             $data['created_on']                = date('Y-m-d H:i:s',time());  
             $data['school_id']                 = $school_id = $_SESSION['school_id'];  
             
             $sql = "DELETE FROM `scl_student_result` WHERE `class_id` = $class_id AND class_name_id = $class_name_id AND school_id = $school_id";   
             $this->db->query($sql);
             
             $marrArr = $_POST['marks'];
             $grade_idArr = $_POST['grade_id'];
             $remarksArr = $_POST['remarks'];
             if($marrArr)
             {
                foreach($marrArr as $key => $value)
                {
                   $data['student_id']  = $key;
                   $data['marks']       = $marrArr[$key];
                   $data['grade_id']    = $grade_idArr[$key];
                   $data['remarks']     = $remarksArr[$key];
                   $this->Admin_model->common_insert($data,'scl_student_result'); 
                } 
             } 
             message('Attendance_id has been added successfully'); 
        } 
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/result/create', $data, true); 
        $this->load->view('admin/template', $data); 
    }
    function teacherlist()
    {
       $data['teacherList'] = $this->Admin_model->get_school_teacher_list($_SESSION['school_id']); 
       $data['mainContent'] = $this->load->view('admin/teacher/teacherlist', $data, true); 
       $this->load->view('admin/template', $data);  
    }
    function ajax_student_name()
    {
        $class_name_id  = $_GET['class_name_id']; 
        $section_id     = $_GET['section_id']; 
        $school_id      = $_SESSION['school_id']; 
    
        $student_id = $this->Admin_model->get_student_name($_SESSION['school_id'],$class_name_id,$section_id); 
        $result = 'success';
        $return = array('result' => $result, 'student_id'=> $student_id);
        print json_encode($return);
        exit;
    } 
    
    function std_list_ajax()
    {
        $class_name_id  = $_GET['class_name_id']; 
        $section_id     = $_GET['section_id']; 
        $school_id      = $_SESSION['school_id']; 
        
        
        $data['attendence'] = $this->Admin_model->get_student_attendence_by_teacher1($school_id,$class_name_id,$section_id);
        #$data['studentInfo'] = $this->Admin_model->std_list_ajax($_SESSION['school_id'],$class_name_id,$section_id);  
        $data['studentList'] = $this->Admin_model->get_all_student_list1($school_id,$class_name_id,$section_id); 
        $list = $this->load->view('admin/student/ajax-student-info', $data, true);  
        
        $actionBtn = $this->load->view('admin/attendence/action_button1', $data, true); 
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list, 'actionBtn'=> $actionBtn);
        print json_encode($return);
        exit; 
    }
    function ajax_message_class_section()
    {
        $class_name_id  = $_GET['class_name_id']; 
        $school_id      = $_SESSION['school_id']; 

        $section_id = $this->Admin_model->get_sectionInfo($_SESSION['school_id'],$class_name_id);  
        $student_id = $this->Admin_model->get_student_name_all($_SESSION['school_id'],$class_name_id);  
        $result = 'success';
        $return = array('result' => $result, 'section_id'=> $section_id, 'student_id'=> $student_id);
        print json_encode($return);
        exit;
    }
    function get_section_students_ajax()
    {
        $class_name_id  = $_GET['class_name_id']; 
        $section_id     = $_GET['section_id']; 
        $school_id      = $_SESSION['school_id']; 

        if($section_id)
        {
            $student_id = $this->Admin_model->get_student_name($_SESSION['school_id'],$class_name_id,$section_id);
        }
        else
        {
            $student_id = $this->Admin_model->get_student_name_all($_SESSION['school_id'],$class_name_id);
        }
          
        $result = 'success';
        $return = array('result' => $result,'student_id'=> $student_id);
        print json_encode($return);
        exit;
    }
    function result_sheet_ajax()
    {
        $class_name_id  = $_GET['class_name_id'];  
        $class_id       = $_GET['class_id'];  
        $school_id      = $_SESSION['school_id']; 
        
        $data['studentInfo'] = $this->Admin_model->result_sheet_ajax($_SESSION['school_id'],$class_name_id);  
        $list = $this->load->view('admin/result/ajax-student-result', $data, true);  
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
    function student_list_ajax()
    {
        $class_name_id  = $_GET['class_name_id'];  
        $school_id      = $_SESSION['school_id']; 
        
        $data['studentInfo'] = $this->Admin_model->student_list_ajax($_SESSION['school_id'],$class_name_id);  
        $list = $this->load->view('admin/student/ajax-student-list', $data, true);  
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
    function get_student_detail($student_id)
    {
        $school_id           = $_SESSION['school_id'];  
        $data['studentInfo'] = $this->Admin_model->get_student_detail($student_id,$school_id); 
        $data['stdResult']   = $this->Admin_model->get_student_result_detail($student_id,$school_id); 
        $this->load->view('admin/student/student_detail', $data);   
    }
    
    function class_subject_ajax()
    {
        $class_name_id  = $_GET['class_name_id'];  
        $school_id      = $_SESSION['school_id']; 
        
        $list = $this->Admin_model->class_subject_ajax($_SESSION['school_id'],$class_name_id);  
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
        
    }
    function class_subject_list()
    {
       $data['class_subject_list'] = $this->Admin_model->get_school_class_subject_list($_SESSION['school_id']); 
       $data['mainContent'] = $this->load->view('admin/newclass/class_subject_list', $data, true); 
       $this->load->view('admin/template', $data);  
    }
    function national_holiday()
    {
        $data['mainContent'] = $this->load->view('admin/message/national_holiday', $data, true); 
        $this->load->view('admin/template', $data);
    }
    function schooladmin()
    {
        if(isPostBack())
        {
             $data['email']             = $_POST['admin_email']; 
             $data['school_id']         = $_POST['school_id']; 
             $data['password']          = md5($_POST['admin_password']); 
             $data['status']            = 1;
             $data['is_superadmin']     = 2;
             $data['created_on']        = date('Y-m-d H:i:s',time());  

             
             $this->Admin_model->common_insert($data,'scl_admin');  
             message('School Admin has been added successfully'); 
        } 
        
        $data['schoolInfo'] = $this->Admin_model->get_school_information($_SESSION['school_id']);    
        $data['mainContent'] = $this->load->view('admin/school/schooladmin', $data, true); 
        $this->load->view('admin/template', $data);
    }
    function section_list()
    {
       $data['section_list'] = $this->Admin_model->get_school_section_list($_SESSION['school_id']); 
       
       #dumpVar($data['section_list']);
       $data['mainContent'] = $this->load->view('admin/newclass/section_list', $data, true); 
       $this->load->view('admin/template', $data);  
    }
    function deleterecord($primary_key_id,$primary_key_name,$table_name,$redirect_function)
    {
        if($primary_key_id && $table_name && $redirect_function)
        {
            $school_id = $_SESSION['school_id'];
            $sql = "DELETE FROM `$table_name` WHERE `$primary_key_name` = $primary_key_id AND school_id = $school_id";
            $this->db->query($sql);
            
            message('Record has been deleted successfully');
            redirect('create/'.$redirect_function); exit;
            #echo $primary_key_id.'======'.$table_name.'============'.$redirect_function;exit;
        }
    }
    
    function delete_section_record($section_id)
    {
        if($section_id)
        {
            $school_id = $_SESSION['school_id'];
            $sql = "DELETE FROM `scl_section` WHERE `section_id` = $section_id AND school_id = $school_id";
            $this->db->query($sql);
            
            $sql = "DELETE FROM `scl_class` WHERE `section_id` = $section_id AND school_id = $school_id";
            $this->db->query($sql);
            
            message('Record has been deleted successfully');
            redirect('create/section_list'); exit;
            #echo $primary_key_id.'======'.$table_name.'============'.$redirect_function;exit;
        }
    }
    
    function student_list()
    {
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/student/student_list', $data, true); 
        $this->load->view('admin/template', $data); 
    }
    function custom_message()
    {
       if(isPostBack())
       {
             $class_name_id          = $_POST['class_name_id']; 
             $section_id             = $_POST['section_id']; 
             $student_ids             = $_POST['student_id']; 
             $message                = $_POST['message']; 
             $school_id              = $_SESSION['school_id']; 
             $condition = '';
             
             ########################################
             if($student_ids)
             {
                 foreach($student_ids as $key => $val)
                 {
                     if($val)
                     {
                        $ids[] = $val; 
                     }
                     else
                     {
                         unset($ids);
                         $comma_ids = '';
                     }
                 }
                 if($ids)
                 {
                     $comma_ids = implode(',',$ids);
                 }
             }
             else
             {
                 $comma_ids = '';
             }
             
             #######################################
             
             if($comma_ids)
             {
                 $condition .= " AND scl_student.student_id IN($comma_ids)"; 
             }
             if($section_id)
             {
                 $condition .= " AND scl_student.section_id = $section_id";
             } 
             if($class_name_id)
             {
                 $condition .= " AND scl_student.class_name_id = $class_name_id";
             } 
             if($school_id)
             {
                 $condition .= " AND scl_student.school_id = $school_id";
             } 

             $smsInfo = $this->Admin_model->get_student_all_information($condition);
             
             $url = 'http://sms.sslwireless.com/xenontech/server.php'; 
             $data['user'] = 'xenon@ssl';
             $data['pass'] = 'xenon_ssl_tech'; 
             $inc = 0;
              if($smsInfo)
              {
                    while($smsInfo)
                    {
                        $data['sid'] = $smsInfo[$inc]['sid']; 
                        $data["sms[$inc][0]"] = $smsInfo[$inc]['gurdian_phon_no']; 
                        $data["sms[$inc][1]"] = $message;
                        unset($smsInfo[$inc]);
                        $inc++;
                    }

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, true);

                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    $output = curl_exec($ch);
                    #$info = curl_getinfo($ch);
                    curl_close($ch); 
                    
                    message('Message has been sent successfully');
              } 
        }
        
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/message/custom_message', $data, true); 
        $this->load->view('admin/template', $data); 
    }
    function resultlist()
    {
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/result/resultlist', $data, true); 
        $this->load->view('admin/template', $data); 
    }
    function get_class_result_list_ajax()
    {
        $data['class_name_id']  = $_GET['class_name_id']; 
        $resultList = $this->load->view('admin/result/ajax-result-list', $data, true);
        
        $result = 'success';
        $return = array('result' => $result, 'resultList'=> $resultList);
        print json_encode($return);
        exit; 
    }
    function student_attendence()
    {
        if(isPostBack())
        {
            $sql = "SELECT * FROM scl_teacher_allowed_attendence WHERE teacher_allowed_attendence_id = {$_POST['teacher_allowed_attendence_id']} LIMIT 1"; 
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $class_name_id = $row['class_name_id'];
            $section_id = $row['section_id'];
            
            $data['class_name_id']              = $class_name_id;  
            $data['section_id']                 = $section_id;  
            
             if(isset($_POST['is_update']) && $_POST['is_update'] == '1')
             {
                  $curDate = date('Y-m-d',time()); 
                  $sql = "DELETE FROM `scl_attendance` WHERE `class_name_id` = $class_name_id AND DATE(created_on) = '$curDate' AND section_id = $section_id";   
                  $this->db->query($sql);
             }
             $data['status']                    = 1;
             $data['created_on']                = date('Y-m-d H:i:s',time());  
             $data['school_id']                 = $_SESSION['school_id'];  
             
             $strArr = $_POST['is_present_hid'];
             $strArrdat = $_POST['is_present'];
             if($strArr)
             {
                foreach($strArr as $key => $value)
                {
                   $data['student_id'] = $key;
                   #$data['section_id']                = $_POST['section_id'][$key];  
                   $data['is_present'] = ($strArrdat[$key] == '1') ? '1':'0';
                   $this->Admin_model->common_insert($data,'scl_attendance'); 
                } 
             }
             message('Attendance_id has been added successfully'); 
        }
        
        $data['class_names'] = $this->Admin_model->teacher_assigned_class_list12($_SESSION['school_id'],$_SESSION['admin_id']); 

        if($data['class_names'])
        {
           if(!isset($_POST['teacher_allowed_attendence_id']))
           {
               $class_name_id = $data['class_names'][0]['class_name_id'];  
               $section_id = $data['class_names'][0]['section_id'];  
           }
           $data['class_name_id'] = $class_name_id;
           $school_id      = $_SESSION['school_id']; 
           
           $data['attendence'] = $this->Admin_model->get_student_attendence_by_teacher3($school_id,$class_name_id,$section_id);
           $data['studentList'] = $this->Admin_model->get_all_student_list3($school_id,$class_name_id,$section_id); 
           $data['mainContent'] = $this->load->view('admin/attendence/student_attendence', $data, true);  
        }
        else
        {
           $data['mainContent'] = $this->load->view('admin/attendence/student_attendence_no_access', $data, true);   
        }
        $this->load->view('admin/template', $data); 
    }
    
    function teacher_attendence_sheet_ajax()
    {
        $teacher_allowed_attendence_id  = $_GET['teacher_allowed_attendence_id']; 
        
        $sql = "SELECT * FROM scl_teacher_allowed_attendence WHERE teacher_allowed_attendence_id = $teacher_allowed_attendence_id";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $school_id      = $_SESSION['school_id']; 
        $data['attendence'] = $this->Admin_model->get_student_attendence_by_teacher21($school_id,$row['class_name_id'],$row['section_id']);
        $data['studentList'] = $this->Admin_model->get_all_student_list21($school_id,$row['class_name_id'],$row['section_id']); 
        $list = $this->load->view('admin/attendence/student_attendence_ajax', $data, true); 
        $actionBtn = $this->load->view('admin/attendence/action_button', $data, true);  
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list, 'actionBtn'=> $actionBtn);
        print json_encode($return);
        exit;  
    }
    
    function send_gurdian_sms($is_admin = 0)
    {
        if(isPostBack())
        {
            
            $curDate = date('Y-m-d',time()); 
            if(isset($_POST['section_id']) && !is_array($_POST['section_id']))
            {
                $section_id = $_POST['section_id']; 
                $class_name_id = $_POST['class_name_id']; 
            }
            else
            {
                if(isset($_POST['teacher_allowed_attendence_id']))
                {
                   $sql = "SELECT * FROM scl_teacher_allowed_attendence WHERE teacher_allowed_attendence_id = {$_POST['teacher_allowed_attendence_id']}"; 
                   $query = $this->db->query($sql); 
                   $row = $query->row_array();
                   
                   $section_id = $row['section_id']; 
                   $class_name_id = $row['class_name_id']; 
                }
            }
            
            $smsInfo = $this->Admin_model->get_student_sms_info($_SESSION['school_id'],$class_name_id,$curDate,$section_id); 
            $inc = 0; 
            $url = 'http://sms.sslwireless.com/xenontech/server.php'; 
            $data['user'] = 'xenon@ssl';
            $data['pass'] = 'xenon_ssl_tech'; 

            if($smsInfo)
            {
                while($smsInfo)
                {
                    $data['sid'] = $smsInfo[$inc]['sid']; 
                    $data["sms[$inc][0]"] = $smsInfo[$inc]['gurdian_phon_no']; 
                    if($smsInfo[$inc]['is_present'] == '1')
                    {
                        $msg = 'Date :'.date('Y-m-d',time()).'; '.$smsInfo[$inc]['name'].' was present';
                    }
                    else
                    {
                        $msg = 'Date :'.date('Y-m-d',time()).'; '.$smsInfo[$inc]['name'].' was absent';
                    }
                    $data["sms[$inc][1]"] = $msg;
                    unset($smsInfo[$inc]);
                    $inc++;
                }
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, true);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $output = curl_exec($ch);
                #$info = curl_getinfo($ch);
                curl_close($ch); 
                
                message('Message has been sent successfully');
            }
        }
        if($is_admin == 0)
        {
            redirect('create/student_attendence');exit;
        }
        else 
        {
            redirect('create/attendance');exit;
        }
    }
    
    function edit_student($student_id)
    {
        if(isPostBack())
        {
             $student_id = $_POST['student_id'];
            
             $data['name']                     = $_POST['name']; 
             $data['father_name']              = $_POST['father_name']; 
             $data['mother_name']              = $_POST['mother_name']; 
             $data['gurdian_name']             = $_POST['gurdian_name']; 
             $data['gurdian_relation']         = $_POST['gurdian_relation']; 
             $data['gurdian_phon_no']          = $_POST['gurdian_phon_no']; 
             $data['class_name_id']            = $_POST['class_name_id']; 
             $data['section_id']               = $_POST['section_id'];  
             $data['roll_no']                  = $_POST['roll_no'];  
             $data['birthdate']                = $_POST['birthdate']; 
             if($_POST['images'][0])
             {
                $data['image']                 = $_POST['images'][0];  
             } 

             $this->Admin_model->edit_table_data($data,'scl_student','student_id',$student_id); 
             message('Student has been updated successfully'); 
            
        }

        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']);  
        $data['sinfo'] = $this->Admin_model->get_student_detail($student_id,$_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/student/edit_student', $data, true); 
        $this->load->view('admin/template', $data);
    }
    #######################################
    function sms()
    {
        if(isPostBack())
        {
             $school_id              = $_SESSION['school_id']; 
             $sql = "SELECT * FROM scl_sms WHERE school_id = $school_id LIMIT 1";
             $query = $this->db->query($sql);
             $row = $query->row_array();
             
             $data['sms'] = $_POST['sms']; 
             
             if($row)
             {
                 $this->Admin_model->common_update('scl_sms',$data,$school_id,'school_id');
                 message('SMS has been updated successfully');  
             }
             else
             {
                 $data['status']  = 1;  
                 $data['school_id']  = $school_id; 
                 $this->Admin_model->common_insert($data,'scl_sms'); 
                 message('SMS has been created successfully');    
             }
        }
        
        $data['sms'] = $this->Admin_model->get_sms($_SESSION['school_id']);  
        $data['mainContent'] = $this->load->view('admin/sms/create', $data, true); 
        $this->load->view('admin/template', $data);
    }  
}
?>