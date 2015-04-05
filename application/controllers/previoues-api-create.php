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
    
    function greeting()
    {
       if(isPostBack())
       {
          $data['greeting_title']   = $_POST['greeting_title'];
          $data['greeting']         = $_POST['greeting'];
          $data['status']           = 1;
          $this->Admin_model->common_insert($data,'scl_greeting');   
          $data['message']          = 'Greeting has been added successfully';
       }
        
       $data['mainContent'] = $this->load->view('admin/greeting/create', $data, true); 
       $this->load->view('admin/template', $data); 
    }
    function greeting_list()
    {
       if(isset($_SESSION['greeting_delete']) && $_SESSION['greeting_delete'] == '1')
       {
          $data['message'] = 'One greeting has been deleted successfully'; 
          unset($_SESSION['greeting_delete']);
       }
       
       $data['greeting'] = $this->Admin_model->common_result_array('scl_greeting');  
       $data['mainContent'] = $this->load->view('admin/greeting/greeting_list', $data, true); 
       $this->load->view('admin/template', $data);        
    }
    function delete_greeting($greeting_id)
    {
       if($greeting_id)
       {
           $sql = "DELETE FROM `scl_greeting` WHERE `greeting_id` = $greeting_id";
           $this->db->query($sql); 
           $_SESSION['greeting_delete'] = '1';   
           redirect('create/greeting_list');exit; 
       } 
    }
    
    function edit_greeting($greeting_id)
    {
        if(isPostBack())
       {
          $data['greeting_title']   = $_POST['greeting_title'];
          $data['greeting']         = $_POST['greeting'];
          $this->Admin_model->common_update('scl_greeting',$data,$greeting_id,'greeting_id');  
          $data['message']          = 'Greeting has been edited successfully';
       }
        
        
        $data['greeting'] = $this->Admin_model->common_cond_row_array('scl_greeting','greeting_id',$greeting_id);
        $data['mainContent'] = $this->load->view('admin/greeting/edit_greeting', $data, true); 
        $this->load->view('admin/template', $data); 
    }
    function view_greeting($greeting_id)
    {
        $data['greeting'] = $this->Admin_model->common_cond_row_array('scl_greeting','greeting_id',$greeting_id);
        $data['mainContent'] = $this->load->view('admin/greeting/view_greeting', $data, true); 
        $this->load->view('admin/template', $data); 
    }
    
    function send_greeting_sms($greeting_id)
    {
         $school_id                    = $_SESSION['school_id']; 
         $smsInfo = $this->Admin_model->common_cond_row_array('scl_greeting','greeting_id',$greeting_id); 
         $smsStudentInfo = $this->Admin_model->get_greeting_sms_student_info($school_id); 
         if($smsStudentInfo)
         {
             $url = ''; 
             $data['user'] = '';
             $data['pass'] = ''; 
             $inc = 0;
             
             while($smsStudentInfo)
             {
                $message = str_replace('<##STUDENTNAME##>',$smsStudentInfo[$inc]['name'],$smsInfo['greeting']);
                 
                $data['sid'] = $smsStudentInfo[$inc]['sid']; 
                $data["sms[$inc][0]"] = $smsStudentInfo[$inc]['gurdian_phon_no']; 
                $data["sms[$inc][1]"] = $message;
                unset($smsStudentInfo[$inc]);
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
             
             $_SESSION['sent_greeting'] = '1';
         }
         redirect('create/greeting_list');  exit;
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
             
             
             $data['nickname']                 = $_POST['nickname'];  
             $data['gender']                   = $_POST['gender'];  
             $data['is_enrolled']              = $_POST['is_enrolled'];
             
             $data['homeaddress']              = $_POST['homeaddress'];  
             $data['city']                     = $_POST['city'];  
             $data['country']                  = $_POST['country'];
             
             
             $data['homephone']                = $_POST['homephone'];  
             $data['cellphone']                = $_POST['cellphone'];  
             $data['email']                    = $_POST['email'];
             
             
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
        $class_name_id = 0;
        $section_id = 0;
        
        if(isPostBack())
        {
             $data['class_name_id']             = $class_name_id = $_POST['class_name_id']; 
             $data['section_id']                = $section_id = $_POST['section_id'];   
             
             if(isset($_POST['is_update']) && $_POST['is_update'] == '1')
             {
                  $curDate = date('Y-m-d',time()); 
                  $sql = "DELETE FROM `scl_attendance` WHERE `class_name_id` = $class_name_id AND DATE(created_on) = '$curDate' AND section_id = $section_id";   
                  $this->db->query($sql);
                  $data['is_message_sent'] = 1; 
             }

             $data['status']                    = 1;
             $data['created_on']                = date('Y-m-d H:i:s',time());  
             $data['school_id']                 = $school_id = $_SESSION['school_id'];  
             
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
             $data['message'] = 'Attendance_id has been added/saved successfully';
             
             ###################
             $data['attendence'] = $this->Admin_model->get_student_attendence_by_teacher12($school_id,$class_name_id,$section_id);
             $data['list'] = $this->load->view('admin/student/ajax-student-info', $data, true);  
             $data['section_ids_arr'] = $this->Admin_model->get_section_by_class_id($school_id,$class_name_id);; 
             ###################
             
        } 
        if(isset($_SESSION['send_sms']))
        {
            $data['message'] = 'SMS has been sent successfully';
        }
        $data['class_name_id'] = $class_name_id; 
        $data['section_id'] = $section_id; 
             
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
             $data['exam_id']                   = $exam_id = $_POST['exam_id']; 
             $data['status']                    = 1;
             $data['created_on']                = date('Y-m-d H:i:s',time());  
             $data['school_id']                 = $school_id = $_SESSION['school_id'];  
             
             
             $data['exam_date']                 = $_POST['exam_date'];
             $data['section_id']                = $_POST['section_id'];
             

             $sql = "DELETE FROM `scl_student_result` WHERE `class_id` = $class_id AND class_name_id = $class_name_id AND school_id = $school_id AND exam_id = $exam_id";   
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
        $data['examList'] = $this->Admin_model->get_exam_list($_SESSION['school_id']); 
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
        $data['studentList'] = aasort($data['studentList'], 'roll_no');
        
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
                    
                    //new code starts here
                    //check if the schoo already exists
	            $school_exists_query = mysql_query("SELECT count(sent_id) FROM scl_sms_count WHERE school_id = $school_id");
	            while($row_s = mysql_fetch_array($school_exists_query))
	            {
	                $school_exists = $row_s['count(sent_id)'];
	            }
	            //if school dont exists then insert scholl and set no_of_sms to 0 initially
	            if($school_exists < 1)
	            {
	                $insert_school['no_of_sms']= 0;
	                $insert_school['school_id']= $school_id;
	                $this->Admin_model->common_insert($insert_school,'scl_sms_count');
	            }
                    
                    
                    $insert_custom_msg['message']= $message;
                    $insert_custom_msg['total_sms']= $inc;
	            $insert_custom_msg['school_id']= $school_id;
	            $this->Admin_model->common_insert($insert_custom_msg,'scl_custom_sms');
	            
	            //check the current no_of_sms sent and then update it
	            $query_no_of_sms=mysql_query("SELECT no_of_sms FROM scl_sms_count WHERE school_id = $school_id");
	            while($row = mysql_fetch_array($query_no_of_sms))
	            {
	                $total_sms_sent = $row['no_of_sms'];
	            }
	            $sms_data['no_of_sms'] = $total_sms_sent + $inc;                
	            $update_sent_sms = $this->Admin_model->common_update('scl_sms_count',$sms_data,$school_id,'school_id');
	            //new code finished here

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
        if(isset($_SESSION['send_sms']))
        {
            $data['message'] = 'SMS has been sent successfully';
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
            
            $smsInfo = $smsInfo2 = $this->Admin_model->get_student_sms_info($_SESSION['school_id'],$class_name_id,$curDate,$section_id); 

            $inc = 0; 
            $url = 'http://sms.sslwireless.com/xenontech/server.php'; 
            $data['user'] = 'xenon@ssl';
            $data['pass'] = 'xenon_ssl_tech'; 

            $sms = $this->Admin_model->get_admin_settings_sms(); 
            
            if($smsInfo)
            {
                while($smsInfo)
                {
                    $data['sid'] = $smsInfo[$inc]['sid']; 
                    $data["sms[$inc][0]"] = $smsInfo[$inc]['gurdian_phon_no']; 
                    #$sms = $smsInfo[$inc]['sms'] ? $smsInfo[$inc]['sms'] : 'NONE';
                    if($smsInfo[$inc]['is_present'] == '1')
                    {
                        //$msg = 'Date :'.date('Y-m-d',time()).'; '.$smsInfo[$inc]['name'].' was present';
                        unset($smsInfo[$inc]);
                        $inc++;
                        continue;
                    }
                    else
                    {
                        //$msg = 'Date :'.date('Y-m-d',time()).'; '.$smsInfo[$inc]['name'].' was absent';
                        $msg = $message = str_replace('<##STUDENTNAME##>', $smsInfo[$inc]['name'], $sms);
                        #$msg = $sms;
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
            if($smsInfo2)
            {
                foreach($smsInfo2 as $sms)
                {
                   $sentstatus['is_message_sent'] = 1;
                   $this->Admin_model->edit_table_data($sentstatus,'scl_attendance','attendance_id',$sms['attendance_id']);
                }
            }
        }
        $_SESSION['send_sms'] = '1';
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
             
             
             $data['nickname']                 = $_POST['nickname'];  
             $data['gender']                   = $_POST['gender'];  
             $data['is_enrolled']              = $_POST['is_enrolled'];
             
             $data['homeaddress']              = $_POST['homeaddress'];  
             $data['city']                     = $_POST['city'];  
             $data['country']                  = $_POST['country'];
                          
             $data['homephone']                = $_POST['homephone'];  
             $data['cellphone']                = $_POST['cellphone'];  
             $data['email']                    = $_POST['email'];
             
             
             
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
    /*NEW CODE FOR TEACHERS*/
    function edit_teacher($teacher_id)
    {
        if(isPostBack())
        {
             $teacher_id = $_POST['teacher_id'];
             $admin_id = $_POST['admin_id'];

             $data1['name']                     = $_POST['name'];
             $data1['subject']              = $_POST['subject'];
             $data1['userid']              = $_POST['userid'];
             $data1['phon_no']             = $_POST['phon_no'];
             $this->Admin_model->edit_table_data($data1,'scl_teacher','teacher_id',$teacher_id);
             
             $data2['email']         = $_POST['email'];
             if(!empty($_POST['password']))
             {
                $data2['password']                    = md5($_POST['password']);
             }
             $this->Admin_model->edit_table_data($data2,'scl_admin','admin_id',$admin_id);
             
             $attendence = $_POST['attendance_class_name_id'];
             $splitArr = explode('-',$attendence );                     
             $assign['class_name_id']   = $splitArr[0];
             $assign['section_id']      = $splitArr[1];
             $this->Admin_model->edit_table_data($assign,'scl_teacher_allowed_attendence','admin_id',$admin_id);
             
             message('Teacher info has been updated successfully');

        }

        redirect('create/teacher_info_edit/'.$teacher_id.'');
        exit();
    }
    
    function teacher_info_edit()
    {
        $teacher_id = $this->uri->segment(3);       
	$data['atnsubject'] = $this->Admin_model->get_teacher_attendence_subject($_SESSION['school_id']); 
        $data['tDetails'] = $this->Admin_model->common_cond_row_array('scl_teacher','teacher_id', $teacher_id);
        $data['mainContent'] = $this->load->view('admin/teacher/teacher_info_edit', $data, true);
        $this->load->view('admin/template', $data);
    }
    /*NEW CODE ENDS HERE*/
    
    /*NEW CODE FOR EDITI CLASS SUBJECT*/
    function edit_class_subject()
    {
        $subject_id = $this->uri->segment(3);       

	$data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']);
        $data['sDetails'] = $this->Admin_model->common_cond_row_array('scl_class','class_id', $subject_id);
        $data['mainContent'] = $this->load->view('admin/newclass/edit_class_subject', $data, true);
        $this->load->view('admin/template', $data);
    }
    function update_class_subject($subject_id)
    {
        if(isPostBack())
        {
             $subject_id = $_POST['subject_id'];

             $data['class_name_id']                     = $_POST['class_name_id'];
             $data['subject']              = $_POST['subject'][0];
            

             $this->Admin_model->edit_table_data($data,'scl_class','class_id',$subject_id);
             message('Class Subject has been updated successfully');

        }

        redirect('create/edit_class_subject/'.$subject_id.'');
        exit();
    }
    /*NEW CODE ENDS HERE*/
    
    function sms()
    {
        if(isPostBack())
        {
             #$school_id              = $_SESSION['school_id']; 
             #$sql = "SELECT * FROM scl_sms WHERE school_id = $school_id LIMIT 1";
             $sql = "SELECT * FROM scl_sms WHERE status = 1 LIMIT 1";
             $query = $this->db->query($sql);
             $row = $query->row_array();
             
             $data['sms'] = $_POST['sms']; 
             
             if($row)
             {
                 $this->Admin_model->common_update('scl_sms',$data,$row['sms_id'],'sms_id');
                 message('SMS has been updated successfully');  
             }
             else
             {
                 $data['status']  = 1;  
                 $this->Admin_model->common_insert($data,'scl_sms'); 
                 message('SMS has been created successfully');    
             }
        }
        
        #$data['sms'] = $this->Admin_model->get_sms($_SESSION['school_id']);  
        $data['sms'] = $this->Admin_model->get_sms();  
        $data['mainContent'] = $this->load->view('admin/sms/create', $data, true); 
        $this->load->view('admin/template', $data);
    } 
    
    function teachersms()
    {
        if(isPostBack())
        {
            $teacher_id = $_POST['teacher_id']; 
            $sms = $_POST['sms']; 
            
            if($teacher_id)
            {
                $con = " AND scl_teacher.teacher_id = $teacher_id";
            }
            else
            {
               $con = ''; 
            }
            $teacherInfo = $this->Admin_model->get_school_sms_teacher_list($_SESSION['school_id'],$con); 
            
            $url = ''; 
            $data['user'] = '';
            $data['pass'] = ''; 
            $inc = 0;  
            
            
            if($teacherInfo)
            {
                foreach($teacherInfo as $sT)
                {
                    $data['sid'] = $sT['sid'] ? $sT['sid'] : ''; 
                    $data["sms[$inc][0]"] = $sT['phon_no']; 
                    $data["sms[$inc][1]"] = $sms;
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
                
                message('SMS has been sent successfully');
            }
        }
 
        $data['teacherList'] = $this->Admin_model->get_sms_teacher_list($_SESSION['school_id']);  
        $data['mainContent'] = $this->load->view('admin/teacher/teachersms', $data, true); 
        $this->load->view('admin/template', $data);
    }
    
    function student_result()
    {
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['examList'] = $this->Admin_model->get_exam_list($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/result/student_result', $data, true); 
        $this->load->view('admin/template', $data); 
    }
    
    function get_class_section_list_rs()
    {
        $class_name_id  = $_GET['class_name_id'];  
        $school_id      = $_SESSION['school_id']; 
        
        $list = $this->Admin_model->get_class_section_list_rs($_SESSION['school_id'],$class_name_id);  
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
    
    function get_class_subject_list_rs()
    {
        $class_name_id  = $_GET['class_name_id'];  
        $section_id  = $_GET['section_id'];  
        $school_id      = $_SESSION['school_id']; 
        
        $list = $this->Admin_model->get_class_subject_list_rs($_SESSION['school_id'],$class_name_id,$section_id);  
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
    
    function result_sheet_ajax_rs()
    {
        $class_name_id      = $_GET['class_name_id'];  
        $class_id           = $_GET['class_id'];  
        $section_id         = $_GET['section_id'];  
        $exam_id            = $_GET['exam_id'];  
        $school_id          = $_SESSION['school_id']; 
        
        #$data['studentInfo'] = $this->Admin_model->result_sheet_ajax($_SESSION['school_id'],$class_name_id);  
        $data['studentInfo'] = $this->Admin_model->result_sheet_ajax_rs($_SESSION['school_id'],$class_name_id,$section_id);  
        $data['studentInfo'] = aasort($data['studentInfo'], 'roll_no');
        
        
        $list = $this->load->view('admin/result/ajax-student-result', $data, true);  

        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
    
    function get_result_sheet_SMS_rs()
    {
        $class_name_id      = $_GET['class_name_id'];  
        $class_id           = $_GET['class_id'];  
        $section_id         = $_GET['section_id'];  
        $exam_id            = $_GET['exam_id'];  
        $school_id          = $_SESSION['school_id']; 
    
        $data['studentInfo'] = $this->Admin_model->get_result_sheet_SMS_rs1($_SESSION['school_id'],$class_name_id,$section_id,$exam_id);  
 
        $list = $this->load->view('admin/result/result_sheet_SMS_rs', $data, true);  
        //$list = $data['studentInfo'];  

        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
    function get_total_student_rs()
    {
        $class_name_id      = $_GET['class_name_id'];  
        $school_id          = $_SESSION['school_id']; 
        
        if($class_name_id)
        {
           $condition = " AND class_name_id = $class_name_id"; 
        }
        $condition .= " AND school_id = $school_id";
        
        $sql = "SELECT COUNT(student_id) as total_student FROM scl_student WHERE status = 1 $condition";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        if($res)
        {
           $list_data = $res['total_student']; 
        }
        else
        {
            $list_data = 0; 
        }
        $list = 'Total student on this class : '.$list_data;
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
    function student_info()
    {
        $school_id          = $_SESSION['school_id'];  
        $sql = "SELECT COUNT(student_id) as total_student FROM scl_student WHERE status = 1 AND school_id = $school_id";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        
        $data['total_student'] = $res['total_student'];; 
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/school/student_info', $data, true); 
        $this->load->view('admin/template', $data);
    }
    
    function exam()
    {
       
       if(isPostBack())
       {
           $data['exam_name'] = $_POST['exam_name'];  
           $data['school_id'] = $_SESSION['school_id'];  
           $this->Admin_model->common_insert($data,'scl_exam'); 
        } 
       $data['mainContent'] = $this->load->view('admin/exam/create', $data, true); 
       $this->load->view('admin/template', $data);  
    }
    
    function send_student_result()
    {
        if(isPostBack()) 
        {
            $class_name_id      = $_POST['class_name_id'];  
            $class_id           = $_POST['class_id'];  
            $section_id         = $_POST['section_id'];  
            $exam_id            = $_POST['exam_id'];  
            $school_id          = $_SESSION['school_id']; 
            
            $smsInfo = $smsInfo2 = $this->Admin_model->get_result_sheet_SMS_rs_v2($_SESSION['school_id'],$class_name_id,$section_id,$exam_id);  

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
                    
                    $msg .= 'Student Name: '.$smsInfo[$inc]['name'].' ,';
                    $msg .= 'Exam Type: '.$smsInfo[$inc]['exam_name'].' ,';
                    $msg .= 'Subject: '.$smsInfo[$inc]['subject'].' ,';
                    $msg .= 'Marks: '.$smsInfo[$inc]['marks'].' ,';
                    $msg .= 'Comment: '.$smsInfo[$inc]['remarks'].' ,';
                    
                    $data["sms[$inc][1]"] = $msg;
                    unset($smsInfo[$inc]);
                    $inc++;
                    $msg = '';
                }
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, true);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $output = curl_exec($ch);
                #$info = curl_getinfo($ch);
                curl_close($ch); 
                
                #message('Message has been sent successfully');
            }
            if($smsInfo2)
            {
                foreach($smsInfo2 as $sinf)
                {
                   $updateIdsArr[] = $sinf['student_result_id']; 
                }
                if($updateIdsArr)
                {
                    $comma_seperated_ids = implode(',',$updateIdsArr);                    
                    $sql = "UPDATE `scl_student_result` SET `is_result_sent` = '1' WHERE `student_result_id` IN($comma_seperated_ids)";
                    $this->db->query($sql);
                    $_SESSION['is_result_sent'] = '1';
                }
            }
        }
        redirect('create/student_result');exit;
    }
    
    function class_migration()
    {       
       if(isPostBack())
       {
           $school_id = $_SESSION['school_id'];
           
           $fromClass= $_POST['from_class_name_id'];
           $fromSection= $_POST['from_section_id'];
           
           $migration = '0';
           
           $toClass= $_POST['to_class_name_id'];
           $toSection= $_POST['to_section_id'];
           
           if(empty($fromClass) || empty($fromSection) || empty($toClass) || empty($toSection))
           {
               echo 'Please Select All Fields Before Migration Process.';
               exit();
           }
           
           ########################################
            if($fromSection)
            {
                foreach($fromSection as $key => $val)
                {
                    if($val)
                    {
                    $fromSection[] = $val; 
                    }
                    else
                    {
                        unset($fromSection);
                        $comma_ids = '';
                    }
                }
                if($fromSection)
                {
                    $comma_ids = implode(',', $fromSection);
                    
                    $isPublishedSql = "SELECT *
                                FROM scl_student
                                INNER JOIN scl_result_summary ON scl_student.student_id = scl_result_summary.student_id
                                WHERE scl_student.school_id = $school_id
                                AND scl_student.class_name_id = $fromClass
                                AND scl_student.migration = $migration
                                AND scl_student.section_id
                                IN ( $comma_ids )
                                ORDER BY `scl_result_summary`.`cgpa` DESC , `scl_result_summary`.`marks` DESC , `scl_student`.`roll_no` ASC";
                    
                    $isPublishedQuery = $this->db->query($isPublishedSql);
                    $isPublishedQueryResult = $isPublishedQuery->result_array();
                    if(!empty($isPublishedQueryResult[0]['student_id']) || !empty($isPublishedQueryResult[0]['position']))
                    {
//                        echo 'Result Published';
                        $total_student_to_be_migrated = count($isPublishedQueryResult);
                        
                        for($i = 0; $i < $total_student_to_be_migrated; $i++)
                        {
                            $data['student_id'] = $isPublishedQueryResult[$i]['student_id'];
                            $data['name'] = $isPublishedQueryResult[$i]['name'];
                            $data['father_name'] = $isPublishedQueryResult[$i]['father_name'];
                            $data['mother_name'] = $isPublishedQueryResult[$i]['mother_name'];
                            $data['gurdian_name'] = $isPublishedQueryResult[$i]['gurdian_name'];
                            $data['gurdian_relation'] = $isPublishedQueryResult[$i]['gurdian_relation'];
                            $data['gurdian_phon_no'] = $isPublishedQueryResult[$i]['gurdian_phon_no'];
                            $data['status'] = $isPublishedQueryResult[$i]['status'];
                            $data['school_id'] = $isPublishedQueryResult[$i]['school_id'];
                            $data['birthdate'] = $isPublishedQueryResult[$i]['birthdate'];
                            $data['image'] = $isPublishedQueryResult[$i]['image'];
                            $data['nickname'] = $isPublishedQueryResult[$i]['nickname'];
                            $data['gender'] = $isPublishedQueryResult[$i]['gender'];
                            $data['is_enrolled'] = $isPublishedQueryResult[$i]['is_enrolled'];
                            $data['homeaddress'] = $isPublishedQueryResult[$i]['homeaddress'];
                            $data['city'] = $isPublishedQueryResult[$i]['city'];
                            $data['country'] = $isPublishedQueryResult[$i]['country'];
                            $data['homephone'] = $isPublishedQueryResult[$i]['homephone'];
                            $data['cellphone'] = $isPublishedQueryResult[$i]['cellphone'];
                            $data['email'] = $isPublishedQueryResult[$i]['email'];
                            $data['class_name_id'] = $toClass;
                            $data['section_id'] = $toSection;
//                            $data['roll_no'] = $isPublishedQueryResult[$i]['position'];
                            $data['roll_no'] = $i+1;
                            $data['created_on'] = date('Y-m-d H:i:s', time());
                            $this->Admin_model->common_insert($data,'scl_migration');
                            
                            unset($data);
                        }
                        echo 'Migration Done Successfully !';
                        exit();
                        
                    }
                    else
                    {
                        echo 'Result Not Published Yet';
                        exit();
                    }
                    exit();
                }
            }
            else
            {
                $comma_ids = '';
            }            
          #######################################
       }
       
       $data['class_name_list'] = $this->Admin_model->get_class_name_info();
       $data['mainContent'] = $this->load->view('admin/migration/migration', $data, true);
       $this->load->view('admin/template', $data);  
    }
      
    
    public function class_migrated()
    {
        $data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        $data['mainContent'] = $this->load->view('admin/migration/migrated', $data, true);
        $this->load->view('admin/template', $data); 
    }
    
    public function final_migration()
    {
        if(isPostBack())
        {
            $school_id = $_SESSION['school_id'];
            $class_name_id = $_POST['class_name_id'];
            $section_id = $_POST['from_section_id'];
            
            $isPublishedSql = "SELECT *
                                FROM scl_migration
                                WHERE school_id = $school_id
                                AND class_name_id = $class_name_id
                                AND section_id =  $section_id                            
                                ORDER BY `roll_no` ASC";
                    
            $isPublishedQuery = $this->db->query($isPublishedSql);
            $isPublishedQueryResult = $isPublishedQuery->result_array();
            if(!empty($isPublishedQueryResult[0]['student_id']))
            {
    //                        echo 'Result Published';
                $total_student_to_be_migrated = count($isPublishedQueryResult);

                for($i = 0; $i < $total_student_to_be_migrated; $i++)
                {                 
                    $data['class_name_id'] = $isPublishedQueryResult[$i]['class_name_id'];
                    $data['section_id'] = $isPublishedQueryResult[$i]['section_id'];
                    $data['roll_no'] = $isPublishedQueryResult[$i]['roll_no'];                    
                    $data['migration'] = '1';
                    $student_id = $isPublishedQueryResult[$i]['student_id'];
                    
                    $this->Admin_model->common_update('scl_student',$data,$student_id,'student_id');
                    unset($data);
                    unset($student_id);
                }
                echo 'Final Migration Done Successfully !';
                exit();

            }
            else
            {
                echo 'Result Not Published Yet';
                exit();
            }
        }
    }
    
    function ajax_migration_class_section()
    {
        $class_name_id  = $_GET['class_name_id']; 
        $school_id      = $_SESSION['school_id']; 

        $section_id = $this->Admin_model->get_sectionInfo($_SESSION['school_id'],$class_name_id);  
        
        $result = 'success';
        $return = array('result' => $result, 'section_id'=> $section_id);
        print json_encode($return);
        exit;
    }
    function student_list_ajax_migrated()
    {
        $class_name_id  = $_GET['class_name_id'];
        $section_id  = $_GET['section_id'];
        $school_id      = $_SESSION['school_id']; 
        
        $data['studentInfo'] = $this->Admin_model->student_list_ajax_migrated($_SESSION['school_id'],$class_name_id, $section_id);  
        $list = $this->load->view('admin/migration/ajax-student-list', $data, true);  
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
        
}
?>