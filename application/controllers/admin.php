<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'Admin_model', true);  
    }
	public function index()
	{ 
        if(!is_admin_loggedin())
        { 
            $this->load->view('admin/login', $data); 
        }
        else
        {
           //dumpVar($_SESSION);
            $data['schoolInfo']        = $this->Admin_model->get_school_info();
            $data['sadminInfo']        = $this->Admin_model->get_school_admin_info();
            $data['smsInfo']        = $this->Admin_model->get_school_sentsms_info();
            $data['mainContent']       = $this->load->view('admin/home', $data, true); 
            $this->load->view('admin/template', $data);
        }
	}
    
    function login()
    {
       if(isPostBack())
       {
          $email = $_POST['email'];
          $password = md5($_POST['password']);
          $adminInfo = $this->Admin_model->admin_login_check($email,$password); 
          
          
          
          if($adminInfo)
          {
             $_SESSION['is_admin_loggedin']     = '1';
             $_SESSION['is_superadmin']         = $adminInfo['is_superadmin'];
             $_SESSION['admin_id']              = $adminInfo['admin_id'];
             $_SESSION['admin_email']           = $adminInfo['email'];

             if($_SESSION['is_superadmin'] != '1')
             {
                 if($_SESSION['is_superadmin'] == '2')
                 {
                     $_SESSION['school_id'] = $adminInfo['school_id'];  
                     $_SESSION['is_school_admin'] = '1';
                 }
                 else if($_SESSION['is_superadmin'] == '3')
                 {   
                     $_SESSION['school_id'] = $adminInfo['school_id'];  
                     $_SESSION['is_school_admin'] = '0';
                 }
                 else if($_SESSION['is_superadmin'] == '0')
                 {
                     $_SESSION['school_id'] = $this->Admin_model->get_school_id($_SESSION['admin_id']);
                     $_SESSION['is_school_admin'] = '0';
                 }
                 $_SESSION['school_name'] = $this->Admin_model->get_school_name_by_school_id($_SESSION['school_id']);
             }
             else if($_SESSION['is_superadmin'] == '1')
             {
                 $_SESSION['school_id'] = $this->Admin_model->get_school_id($_SESSION['admin_id']);   
                 $_SESSION['is_school_admin'] = '0';
                 $_SESSION['school_name'] = '';
             }
             redirect('admin');exit;
          }
          redirect('admin');exit; 
       } 
    }
    
    function login_frontend()
    {
       if(isPostBack())
       {
          $email = $_POST['email'];
          $password = md5($_POST['password']);
          $user_type = $_POST['user_type'];
          $adminInfo = $this->Admin_model->admin_login_check_front($email,$password,$user_type); 
          
          
          
          if($adminInfo)
          {
             $_SESSION['is_admin_loggedin']     = '1';
             $_SESSION['is_superadmin']         = $adminInfo['is_superadmin'];
             $_SESSION['admin_id']              = $adminInfo['admin_id'];
             $_SESSION['admin_email']           = $adminInfo['email'];

             if($_SESSION['is_superadmin'] != '1')
             {
                 if($_SESSION['is_superadmin'] == '2')
                 {
                     $_SESSION['school_id'] = $adminInfo['school_id'];  
                     $_SESSION['is_school_admin'] = '1';
                 }
                 else if($_SESSION['is_superadmin'] == '3')
                 {   
                     $_SESSION['school_id'] = $adminInfo['school_id'];  
                     $_SESSION['is_school_admin'] = '0';
                 }
                 else if($_SESSION['is_superadmin'] == '0')
                 {
                     $_SESSION['school_id'] = $this->Admin_model->get_school_id($_SESSION['admin_id']);
                     $_SESSION['is_school_admin'] = '0';
                 }
                 $_SESSION['school_name'] = $this->Admin_model->get_school_name_by_school_id($_SESSION['school_id']);
             }
             else if($_SESSION['is_superadmin'] == '1')
             {
                 $_SESSION['school_id'] = $this->Admin_model->get_school_id($_SESSION['admin_id']);   
                 $_SESSION['is_school_admin'] = '0';
                 $_SESSION['school_name'] = '';
             }
             redirect('admin');exit;
          }
          redirect('welcome');exit; 
       } 
    }
    
    function logout()
    {
        unset($_SESSION['is_admin_loggedin'],$_SESSION['admin_id'],$_SESSION['admin_email'],$_SESSION['school_id'],$_SESSION['is_school_admin'],$_SESSION['school_name']);   
        message('Logout successfully');
        redirect('admin');exit;
    }
}