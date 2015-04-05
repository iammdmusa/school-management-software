<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tabulation_sheet extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('custom_model');
    }

	public function index() {}


    public function getSection() {
        if($this->input->post('ajax')) {
            $school_id = $_SESSION['school_id'];
            $class_name_id = $this->input->post('class_name_id');
            echo "<option value=''>Select One</option>";
            $sections = $this->custom_model->getSections($school_id, $class_name_id);
            if($sections) {
                foreach($sections as $section) {
                    echo "<option value='$section->section_id'>$section->section</option>";
                }
            }
        }
    }

    public function getClassExam() {
        if($this->input->post('ajax')) {
            $school_id = $_SESSION['school_id'];
            $class_name_id = $this->input->post('class_name_id');
            $section_name_id = $this->input->post('section_name_id');
            echo "<option value=''>Select One</option>";
            $exams = $this->custom_model->getClassExam($school_id, $class_name_id, $section_name_id);
            if($exams) {
                foreach($exams as $exam) {
                    echo "<option value='$exam->exam_id'>$exam->exam_name</option>";
                }
            }
        }
    }

    public function getResultDetails() {
        if($this->input->post('ajax')) {
            $school_id = $_SESSION['school_id'];
            $class_name_id = $this->input->post('class_name_id');
            $section_name_id = $this->input->post('section_name_id');
            $exam_name_id = $this->input->post('exam_name_id');

            $data['subjects'] = array();
            $data['summary'] = array();
            $i = 0;
            $subject_flag = true;
            $result_flag = false;
            $data['school_name'] = $this->custom_model->getSchoolName($school_id);
            $data['students'] = $this->custom_model->getStudentsByClassSection($class_name_id, $section_name_id);
            foreach($data['students'] as &$student) {
                $total_marks = 0; $gpa = 0;
                $student->results = $this->custom_model->getStudentResult($student->student_id, $class_name_id, $section_name_id, $exam_name_id, $school_id);
                if($subject_flag) {
                    foreach($student->results as $result) {
                        $data['subjects'][$i++] = $result->subject;
                    }
                    $subject_flag = false;
                }
                foreach($student->results as $result) {
                    $total_marks += $result->marks;
                    if($result->grade_id == "A+") {
                        $gpa += 5;
                    } else if($result->grade_id == "A") {
                        $gpa += 4;
                    } else if($result->grade_id == "A-") {
                        $gpa += 3.5;
                    } else if($result->grade_id == "B") {
                        $gpa += 3;
                    } else if($result->grade_id == "C") {
                        $gpa += 2;
                    } else if($result->grade_id == "D") {
                        $gpa += 1;
                    } else {
                        $gpa += 0;
                    }
                }
                $student->result_summary = $this->custom_model->getStudentResultSummary($student->student_id, $class_name_id, $section_name_id, $school_id);
                $data['summary']['total_marks'][$student->student_id] = $total_marks;
                $data['summary']['gpa'][$student->student_id] = $gpa / count($data['subjects']);
                $data['summary']['position'][$student->student_id] = $total_marks;
            }
            if($result_flag) {
                echo "No Result Found";
            } else {
                arsort($data['summary']['position']);
                $data['summary']['rank'] = array();
                $i = 1;
                foreach ($data['summary']['position'] as $key => $value) {
                    $data['summary']['rank'][$key] = $i++;
                }
                /*
                for($i=1; $i<=count($data['summary']['position']); $i++) {
                    $data['summary']['rank'][$i] = $data['summary']['position']{}
                }*/
                //echo "<pre>", print_r($data['summary']['rank']), "</pre>"; die();
                $data['class_name_id'] = $class_name_id;
                $data['section_name_id'] = $section_name_id;
                $data['exam_name_id'] = $exam_name_id;
                $this->load->view('admin/result/tabulation_view', $data);
            }
        }
    }

    public function update() {
        if($this->input->post('submit')) {
            $school_id = $_SESSION['school_id'];
            $class_name_id = $this->input->post('class_name_id');
            $section_name_id = $this->input->post('section_name_id');
            $exam_name_id = $this->input->post('exam_name_id');

            $students = $this->custom_model->getStudentsByClassSection($class_name_id, $section_name_id);
            foreach($students as $student) {
                $results = $this->custom_model->getStudentResult($student->student_id, $class_name_id, $section_name_id, $exam_name_id, $school_id);
                foreach($results as $result) {
                    $result_id = $result->student_result_id;
                    $marks = $this->input->post("marks_" . $result_id);
                    $grade = $this->input->post("grade_" . $result_id);
                    $this->custom_model->updateResult($result_id, $marks, $grade);
                }

                $result_summary = $this->custom_model->getStudentResultSummary($student->student_id, $class_name_id, $section_name_id, $school_id);                
                if($this->input->post('new_' . $student->student_id)) {
                    $this->custom_model->insertResultSummary($school_id, $student->student_id);
                } else {
                    foreach($result_summary as $summary) {
                        $summary_id = $summary->result_summary_id;
                        $s_marks = $this->input->post("s_marks_" . $summary_id);
                        $s_position = $this->input->post("s_position_" . $summary_id);
                        $s_cgpa = $this->input->post("s_cgpa_" . $summary_id);
                        $this->custom_model->updateResultSummary($summary_id, $s_marks, $s_position, $s_cgpa);
                    }
                }
            }
            $this->printTabulationSheet($school_id, $class_name_id, $section_name_id, $exam_name_id, $students);
        }
    }

    private function printTabulationSheet($school_id, $class_name_id, $section_name_id, $exam_name_id, $students) {
        $data['subjects'] = array();
        $i = 0; 
        $subject_flag = true;
        $result_flag = false;
        $data['school_name'] = $this->custom_model->getSchoolName($school_id);
        $data['students'] = $students;
        foreach($data['students'] as &$student) {
            $student->results = $this->custom_model->getStudentResult($student->student_id, $class_name_id, $section_name_id, $exam_name_id, $school_id);
            if($subject_flag) {
                foreach($student->results as $result) {
                    $data['subjects'][$i++] = $result->subject;
                }
                $subject_flag = false;
            }
            /*
            if(!$student->results) {
                $result_flag = true;
                break;
            }
            */
            $student->result_summary = $this->custom_model->getStudentResultSummary($student->student_id, $class_name_id, $section_name_id, $school_id);
        }
        if($result_flag) {
            echo "No Result Found";
        } else {
            $data['class_name'] = $this->custom_model->getClassName($class_name_id);
            $data['section_name'] = $this->custom_model->getSectionName($section_name_id);
            $data['exam_name'] = $this->custom_model->getExamName($exam_name_id);
            $this->load->view('admin/result/tabulation_print', $data);
        }
    }

    public function getStudent() {
        if($this->input->post('ajax')) {
            $student_id = $this->input->post('student_id');
            $data['studentInfo'] = $this->custom_model->getStudent($student_id);  
            $this->load->view('admin/student/ajax-student-list', $data);
        }
    }

}