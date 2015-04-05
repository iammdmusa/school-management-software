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
//      $is_sms_sent = $this->Report_model->get_is_sms_sent($school_id,$section_id,$class_id,$class_name_id);

        $data['usrAction'] = $this->Report_model->radioaction_list($school_id,$section_id,$class_id,$class_name_id);
        $radioAction = $this->load->view('admin/result/unsent-exam-radio-action', $data, true);
        
        
        
        $result = 'success';
        $return = array('result' => $result, 'list'=> $list, 'radioAction'=> $radioAction);
        print json_encode($return);
        exit; 
    }
    
    function send_student_result()
    {
        if(isPostBack()) 
        {
            dumpVar($_POST);
            
            
            $class_name_id      = $_POST['class_name_id'];  
            $class_id           = $_POST['class_id'];  
            $section_id         = $_POST['section_id'];  
            $exam_id            = $_POST['examselection'];  
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
}
?>