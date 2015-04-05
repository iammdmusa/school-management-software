<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller 
{  
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'Admin_model', true); 
        $this->load->model('report_model', 'Report_model', true);
        $this->load->library('pagination'); 
        if(!is_admin_loggedin())
        { 
            redirect('admin');exit;
        } 
    }
    public function index()
    { 

    }
    
    function get_class_section_list_rs()
    {
        $class_name_id  = $_GET['class_name_id'];  
        $school_id      = $_SESSION['school_id']; 
        
        $list = $this->Report_model->get_class_section_list_rs($school_id,$class_name_id);  
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list);
        print json_encode($return);
        exit; 
    }
    function get_class_subject_list_rs()
    {
        $class_name_id  = $_GET['class_name_id'];  
        $section_id     = $_GET['section_id'];  
        $school_id      = $_SESSION['school_id']; 
        
        $list = $this->Report_model->get_class_subject_list_rs($school_id,$class_name_id,$section_id);  
        $data['a_subject'] = $this->Report_model->print_exam_list($class_name_id,$school_id,$section_id); 
        $a_subject = $this->load->view('admin/result/a_subject', $data, true);
        
        
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list, 'a_subject'=> $a_subject);
        print json_encode($return);
        exit; 
    }
    function get_result_sheet_SMS_rs()
    {
        $class_name_id      = $_GET['class_name_id'];  
        $class_id           = $_GET['class_id'];  
        $section_id         = $_GET['section_id'];           
        $school_id          = $_SESSION['school_id']; 
        
        $data['class_name_id'] = $class_name_id;
        $data['section_id'] = $section_id;
        $data['school_id'] = $school_id;
        $data['class_id'] = $class_id;
        
    
        #$data['studentInfo'] = $this->Report_model->get_result_sheet_SMS_rs1($school_id,$class_name_id,$section_id,$exam_id);  
        $data['classExam'] = $this->Report_model->get_result_sheet_SMS_rs1($school_id,$section_id,$class_id,$class_name_id);  
 
        #$list = $this->load->view('admin/result/result_sheet_SMS_rs', $data, true);  
        //$list = $data['studentInfo'];  
        $list = $this->load->view('admin/result/result_sheet_SMS_rs_v2_1', $data, true); 
        //$is_sms_sent = $this->Report_model->get_is_sms_sent($school_id,$section_id,$class_id,$class_name_id);

        $data['usrAction'] = $this->Report_model->radioaction_list($school_id,$section_id,$class_id,$class_name_id);
        $data['usrActionAllExam'] = $this->Report_model->all_exam_list($school_id,$section_id,$class_id,$class_name_id);
        $radioAction = $this->load->view('admin/result/unsent-exam-radio-action', $data, true);
        
        
        $usrActionAllExam = $this->load->view('admin/result/all-exam-radio-action', $data, true);
        
        
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list,'radioAction'=> $radioAction,'usrActionAllExam'=> $usrActionAllExam);
        print json_encode($return);
        exit; 
    }
    
    function send_student_result()
    {
        if(isPostBack()) 
        {
            $class_name_id      = $_POST['class_name_id'];  
            $class_id           = $_POST['class_id'];  
            $section_id         = $_POST['section_id'];  
            $exam_id            = $_POST['examselection'];  
            $school_id          = $_SESSION['school_id']; 
            
            $smsInfo = $smsInfo2 = $this->Admin_model->get_result_sheet_SMS_rs_v2($_SESSION['school_id'],$class_name_id,$section_id,$exam_id);  

            $inc = 0; 
            $url = ''; 
            $data['user'] = '';
            $data['pass'] = ''; 

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
    
    function update_result_table()
    {
        $sql = "SELECT student_id,section_id FROM scl_student WHERE status = 1";
        $query = $this->db->query($sql);
        $res = $query->result_array(); 
        
        if($res)
        {
            foreach($res as $r)
            {
                $data['section_id'] = $r['section_id'];
                $this->Admin_model->common_update('scl_student_result',$data,$r['student_id'],'student_id'); 
            }
        }
    }
    
    function result_pdf()
    {
        //$data['class'] = $this->Admin_model->get_distinct_class($_SESSION['school_id']); 
        
        
        $class_name_id = 1;
        $section_id = 14;
        $data['stdList'] = $this->Report_model->get_student_list_pdf($_SESSION['school_id'],$class_name_id,$section_id);                 
        
        #$data['mainContent'] = $this->load->view('admin/result/result_pdf', $data, true); 
        $data['mainContent'] = $this->load->view('admin/pdf_result_generation', $data, true); 
        $this->load->view('admin/template', $data);
    }
    #STEP 1
    function ajax_result_print_step_1()
    {
        $session_id = session_id();
        $sql = "SELECT * FROM scl_session_print WHERE session_id = '$session_id' AND is_print = 0 AND student_id = 0 LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        $sql = "SELECT * FROM scl_session_print WHERE  student_id != 0";
        $query = $this->db->query($sql);
        $res_n = $query->result_array();
        
        $comma_seperated_ids = '';
        $condition = '';
        
        if($res_n)
        {
          foreach($res_n as $rn)
          {
             $rnArr[] = $rn['student_id']; 
          }
          $comma_seperated_ids = implode(',',$rnArr);
          $condition = " AND student_id NOT IN($comma_seperated_ids)";
        }
        
        
        
        
        
        $class_name_id = '';
        $section_id = '';
        $exam_id = '';
        $school_id = '';
        $student_id = '';
        
        
        if($res)
        {
           $class_name_id = $res['class_name_id'];
           $section_id = $res['section_id'];
           $exam_id  = $res['exam_id'];
           $school_id  = $_SESSION['school_id']; 
           
           
           $sql = "SELECT student_id FROM scl_student_result
                   WHERE class_name_id = $class_name_id
                   AND section_id = $section_id
                   AND exam_id = $exam_id
                   AND school_id = $school_id $condition LIMIT 1";
           $query = $this->db->query($sql);
           $res = $query->row_array();
           if($res['student_id'])
           {
               $student_id = $res['student_id'];
               $result = 'success';
           }
           else
           {
                $result = 'fail';
           }
        }
        else
        {
            $result = 'fail';
        }
        
        
        $return = array(
                    'result' => $result, 
                    'student_id'=> $student_id, 
                    'school_id'=> $school_id, 
                    'exam_id'=> $exam_id, 
                    'section_id'=> $section_id,
                    'class_name_id'=> $class_name_id 
                    );
        print json_encode($return);
        exit; 
    }
    #STEP 2
    function ajax_result_print_step_2($student_id,$school_id,$exam_id,$section_id,$class_name_id)
    {
//       echo 'student_id '.$student_id.'<br/>'; 
//       echo 'school_id '.$school_id.'<br/>'; 
//       echo 'exam_id '.$exam_id.'<br/>'; 
//       echo 'section_id '.$section_id.'<br/>'; 
//       echo 'class_name_id '.$class_name_id.'<br/>'; 
//       
//       exit;
        
        $sql = "SELECT s.student_id,
                              s.name,
                              s.gender,
                              s.homeaddress,
                              s.image as std_image,
                              s.birthdate,
                              sc.school_id,
                              sc.school_name,
                              r.marks,
                              r.grade_id,
                              r.remarks,
                              r.school_id,
                              ss.subject
                       FROM scl_student s
                       INNER JOIN scl_school sc ON sc.school_id = s.school_id
                       INNER JOIN scl_student_result r ON r.student_id = s.student_id AND r.school_id = s.school_id
                       INNER JOIN scl_class ss ON ss.class_id = r.class_id AND ss.class_name_id = r.class_name_id AND ss.section_id = r.section_id
                       WHERE r.class_name_id = $class_name_id
                       AND r.section_id = $section_id
                       AND r.exam_id = $exam_id
                       AND r.school_id = $school_id
                       AND s.student_id = $student_id";
           $query = $this->db->query($sql);
           $data['result'] = $query->result_array();
           $this->load->view('admin/pdf_result_generation', $data);
    }
    function close_student_report()
    {
        $class_name_id = $_GET['class_name_id'];
        $section_id = $_GET['section_id'];
        $exam_id  = $_GET['exam_id'];
        $school_id  = $_GET['school_id']; 
        $student_id  = $_GET['student_id']; 
        
        $session_id = session_id();
        
        $sql = "SELECT session_print_id FROM scl_session_print 
                WHERE session_id = '$session_id' 
                AND class_name_id = $class_name_id
                AND section_id = $section_id
                AND exam_id = $exam_id
                AND school_id = $school_id LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        $session_print_id = $res['session_print_id'];
        
        if($session_print_id)
        {
           $data['is_print'] = 1;
           $data['student_id'] = $student_id;
           
           $this->db->where ('session_print_id',$session_print_id);
           $this->db->update ('scl_session_print',$data );
        }
        
        $result = 'success';
        $return = array('result' => $result,'session_print_id' => $session_print_id);
        print json_encode($return);
        exit;
    }
    
    public function ajax_result_print()
    {
        $session_id = session_id();
        $sql = "SELECT * FROM scl_session_print WHERE session_id = '$session_id' AND is_print = 0 AND student_id = 0 LIMIT 1";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        
        
        
        if($res)
        {
           $class_name_id = $res['class_name_id'];
           $section_id = $res['section_id'];
           $exam_id  = $res['exam_id'];
           $school_id  = $_SESSION['school_id'];
           
           $sql = "SELECT student_id FROM scl_student_result
                   WHERE class_name_id = $class_name_id
                   AND section_id = $section_id
                   AND exam_id = $exam_id
                   AND school_id = $school_id LIMIT 1";
           $query = $this->db->query($sql);
           $res = $query->row_array();
           if($res['student_id'])
           {
               $student_id = $res['student_id'];
               $sql = "SELECT s.student_id,
                              s.name,
                              s.gender,
                              s.homeaddress,
                              s.image as std_image,
                              s.birthdate,
                              sc.school_id,
                              sc.school_name,
                              r.marks,
                              r.grade_id,
                              r.remarks,
                              r.school_id,
                              ss.subject
                       FROM scl_student s
                       INNER JOIN scl_school sc ON sc.school_id = s.school_id
                       INNER JOIN scl_student_result r ON r.student_id = s.student_id AND r.school_id = s.school_id
                       INNER JOIN scl_class ss ON ss.class_id = r.class_id AND ss.class_name_id = r.class_name_id AND ss.section_id = r.section_id
                       WHERE r.class_name_id = $class_name_id
                       AND r.section_id = $section_id
                       AND r.exam_id = $exam_id
                       AND r.school_id = $school_id
                       AND s.student_id = $student_id";
               $query = $this->db->query($sql);
               $data['result'] = $query->result_array();
               
               
           }
           $data['mainContent'] = $this->load->view('admin/pdf_result_generation', $data, true); 
           $this->load->view('admin/template', $data);
        }        
    }
    
    function print_page()
    {
       $data['mainContent'] = $this->load->view('admin/print_page', $data, true); 
       $this->load->view('admin/template', $data); 
    }
    
    function pdf_result_generation($student_id)
    {
        $school_id = $_SESSION['school_id'];
        $this->load->view('admin/pdf_result_generation', $data);
    }
    
    function set_print_info()
    {
        $class_name_id = $_GET['class_name_id'];
        #$class_id = $_GET['class_id'];
        $section_id = $_GET['section_id'];
        $exam_id = $_GET['print_examselection'];
        $session_id = session_id();
        $school_id = $_SESSION['school_id'];
        
        
        
        $sql = "SELECT session_print_id 
                FROM scl_session_print 
                WHERE class_name_id = $class_name_id                 
                AND section_id = $section_id
                AND exam_id = $exam_id
                AND session_id = '$session_id'
                AND school_id = $school_id
                LIMIT 1";
       
        
        
       $query = $this->db->query($sql);
       $res = $query->row_array();
       
       if($res['session_print_id'])
       {
            $result = 'fail';
            $return = array('result' => $result);
            print json_encode($return);
            exit;
       }
        
        
        $sql = "SELECT student_result_id 
                FROM scl_student_result 
                WHERE class_name_id = $class_name_id                 
                AND section_id = $section_id
                AND exam_id = $exam_id";
        
        $query = $this->db->query($sql);
        $result = $query->result_array();
        if($result)
        {
           foreach($result as $r)
           {
              $data['class_name_id'] = $class_name_id;
              $data['school_id'] = $school_id;
              $data['section_id'] = $section_id;
              $data['exam_id'] = $exam_id;                                                        
              $data['session_id'] = $session_id;              
              $data['student_result_id'] = $r['student_result_id'];
              $this->Admin_model->common_insert($data,'scl_session_print');  
           }
        }
        
        $result = 'success';
        $return = array('result' => $result);
        print json_encode($return);
        exit;
    }
    
    function sms_statistics()
    {        	
        $school_id = $this->uri->segment(3);
        $sql = "SELECT * 
                FROM scl_custom_sms 
                WHERE school_id = $school_id"; 
                         
        $query = $this->db->query($sql);
        $data['smsDetails'] = $query->result_array();
        
        $total_result_sms = mysql_query("SELECT no_of_sms FROM scl_sms_count WHERE school_id = $school_id");
        while($row=mysql_fetch_array($total_result_sms))
        {
        	$data['total'] = $row['no_of_sms'];
        }
        $data['mainContent']       = $this->load->view('admin/custom_msg_details', $data, true);
        $this->load->view('admin/template', $data);
    }
    
    
}
?>