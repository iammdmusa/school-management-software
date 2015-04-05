<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if(!is_admin_loggedin()) { 
            redirect('admin');
        }
        $this->load->model('custom_model');
    }

    public function index() {
    	echo "Access Denied";
    }

    public function list_exam() {
    	$school_id = $_SESSION['school_id'];
    	$data['exams'] = $this->custom_model->getExams($school_id);
    	$data['mainContent'] = $this->load->view('admin/exam/list_view', $data, true);
    	$this->load->view('admin/template', $data);
    }

    public function edit($exam_id) {
    	$data['exam'] = $this->custom_model->getExam($exam_id);
    	$data['mainContent'] = $this->load->view('admin/exam/edit_view', $data, true);
    	$this->load->view('admin/template', $data);
    }

    public function update() {
    	if($this->input->post('submit')) {
    		$exam_id = $this->input->post('exam_id');
    		$exam_name = $this->input->post('exam_name');
    		$this->custom_model->updateExam($exam_id, $exam_name);
    		redirect("exam/edit/$exam_id");
    	}
    }

    public function delete($exam_id) {
        $school_id = $_SESSION['school_id'];
        $exists = $this->custom_model->checkExam($school_id, $exam_id);
        if($exists) {
            if($this->custom_model->deleteExam($school_id, $exam_id)) {
                echo "Exam Deleted <br>";
            } else {
                echo "Exam Deleted error<br>";
            }
            if($this->custom_model->deleteSessionPrint($school_id, $exam_id)) {
                echo "Session Print Exam Deleted <br>";
            } else {
                echo "Session Print Deleted Error <br>";
            }
            if($this->custom_model->deleteResultSummary($school_id, $exam_id)) {
                echo "Summary Deleted <br>";
            } else {
                echo "Summary Deleted Error<br>";
            }
            if($this->custom_model->deleteStudentResult($school_id, $exam_id)) {
                echo "Result Deleted <br>";
            } else {
                echo "Result Deleted Error<br>";
            }
            redirect('exam/list_exam');
        } else {
            die("You are not allowed to delete this exam");
        }
    }

}