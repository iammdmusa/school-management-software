<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_model extends CI_Model {
    
    public function getSections($school_id, $class_name_id) {
    	$this->db->distinct();
    	$this->db->select('section_id');
    	$this->db->where('scl_class.school_id', $school_id);
    	$this->db->where('scl_class.class_name_id', $class_name_id);
    	$query = $this->db->get('scl_class');
    	$result = $query->result();
    	foreach($result as &$row) {
    		$row->section = $this->getSectionByID($row->section_id);
    	}
    	return $result;
    }

    public function getClassExam($school_id, $class_name_id, $section_id) {
        $this->db->distinct();
        $this->db->select('exam_id');
        $this->db->where('scl_student_result.school_id', $school_id);
        $this->db->where('scl_student_result.class_name_id', $class_name_id);
        $this->db->where('scl_student_result.section_id', $section_id);
        $query = $this->db->get('scl_student_result');
        $result = $query->result();
        foreach($result as &$row) {
            $row->exam_name = $this->getExamByID($row->exam_id);
        }
        return $result;
    }

    public function getSectionByID($section_id) {
    	$this->db->where('section_id', $section_id);
    	$query = $this->db->get('scl_section');
    	foreach ($query->result() as $row) {
    		return $row->section;
    	}
    }

    public function getExamByID($exam_id) {
        $this->db->where('exam_id', $exam_id);
        $query = $this->db->get('scl_exam');
        foreach ($query->result() as $row) {
            return $row->exam_name;
        }
    }

    public function getExams($school_id) {
    	$this->db->where('status', 1);
    	$this->db->where('school_id', $school_id);
    	$query = $this->db->get('scl_exam');
    	return $query->result();
    }

    public function getExam($exam_id) {
        $this->db->where('status', 1);
        $this->db->where('exam_id', $exam_id);
        $query = $this->db->get('scl_exam');
        return $query->result();
    }

    public function getStudentsByClassSection($class_name_id, $section_name_id) {
    	$this->db->where('class_name_id', $class_name_id);
    	$this->db->where('section_id', $section_name_id);
        $this->db->order_by('roll_no');
    	$query = $this->db->get('scl_student');
    	return $query->result();
    }

    public function getStudentResult($student_id, $class_name_id, $section_id, $exam_id, $school_id) {
    	$this->db->where('scl_student_result.class_name_id', $class_name_id);
    	$this->db->where('scl_student_result.section_id', $section_id);
    	$this->db->where('student_id', $student_id);
    	$this->db->where('exam_id', $exam_id);
    	$this->db->where('scl_student_result.school_id', $school_id);
        $this->db->where("scl_class.class_id = scl_student_result.class_id");
        $this->db->order_by('scl_class.subject', 'ASC');
    	$query = $this->db->get('scl_class, scl_student_result');
    	return $query->result();
    }

    public function getStudentResultSummary($student_id, $class_name_id, $section_id, $school_id) {
        $this->db->where('class_name_id', $class_name_id);
        $this->db->where('section_id', $section_id);
        $this->db->where('student_id', $student_id);
        $this->db->where('school_id', $school_id);
        $query = $this->db->get('scl_result_summary');
        return $query->result();
    }

    public function getSubjects($class_name_id, $section_name_id, $school_id) {
        $this->db->distinct();
        $this->db->select('subject');
        $this->db->where('class_name_id', $class_name_id);
        $this->db->where('section_id', $section_name_id);
        $this->db->where('school_id', $school_id);
        $this->db->order_by('subject', 'ASC');
        $query = $this->db->get('scl_class');
        return $query->result();
    }

    public function getSchoolName($school_id) {
        $this->db->where('school_id', $school_id);
        $query = $this->db->get('scl_school');
        foreach($query->result() as $row) {
            return $row->school_name;
        }
    }

    public function updateResult($student_result_id, $marks, $grade_id) {
        $data['marks'] = $marks;
        $data['grade_id'] = $grade_id;
        $this->db->where('student_result_id', $student_result_id);
        return $this->db->update('scl_student_result', $data);
    }

    public function insertResultSummary($school_id, $student_id) {
        $data = array(
            'student_id' => $student_id,
            'cgpa' => $this->input->post("s_cgpa_" . $student_id),
            'position' => $this->input->post("s_position_" . $student_id),
            'school_id' => $school_id,
            'class_name_id' => $this->input->post('class_name_id'),
            'section_id' => $this->input->post('section_name_id'),
            'marks' => $this->input->post("s_marks_" . $student_id),
        );
        return $this->db->insert('scl_result_summary', $data);
    }

    public function updateResultSummary($result_summary_id, $marks, $position, $cgpa) {
        $data['marks'] = $marks;
        $data['position'] = $position;
        $data['cgpa'] = $cgpa;
        $this->db->where('result_summary_id', $result_summary_id);
        return $this->db->update('scl_result_summary', $data);
    }

    public function getClassName($class_name_id) {
        $this->db->where('class_name_id', $class_name_id);
        $query = $this->db->get('scl_class_name');
        foreach($query->result() as $row) {
            return $row->classname;
        }
    }

    public function getSectionName($section_id) {
        $this->db->where('section_id', $section_id);
        $query = $this->db->get('scl_section');
        foreach($query->result() as $row) {
            return $row->section;
        }
    }

    public function getExamName($exam_id) {
        $this->db->where('exam_id', $exam_id);
        $query = $this->db->get('scl_exam');
        foreach($query->result() as $row) {
            return $row->exam_name;
        }
    }

    public function checkDisplayID($display_id) {
        $this->db->where('display_id', $display_id);
        $query = $this->db->get('scl_student');
        return $query->result();
    }

    public function getStudent($student_id) {
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
                WHERE s.student_id = $student_id"; 
         $query = $this->db->query($sql);
         $res = $query->result_array();       
         return $res;
    }
    
        public function getStudentByDisplayID($display_id) {
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
                WHERE s.display_id = $display_id"; 
         $query = $this->db->query($sql);
         $res = $query->result_array();       
         return $res;
    }

    public function updateExam($exam_id, $exam_name) {
        $data['exam_name'] = $exam_name;
        $this->db->where('exam_id', $exam_id);
        return $this->db->update('scl_exam', $data);
    }

    public function checkExam($school_id, $exam_id) {
        $this->db->where('school_id', $school_id);
        $this->db->where('exam_id', $exam_id);
        $query = $this->db->get('scl_exam');
        return $query->result();
    }


    public function deleteExam($school_id, $exam_id) {
        $this->db->where('school_id', $school_id);
        $this->db->where('exam_id', $exam_id);
        return $this->db->delete('scl_exam');
    }

    public function deleteSessionPrint($exam_id) {
        $this->db->where('school_id', $school_id);
        $this->db->where('exam_id', $exam_id);
        return $this->db->delete('scl_session_print');
    }

    public function getResultDetails($school_id, $exam_id) {
        $this->db->where('school_id', $school_id);
        $this->db->where('exam_id', $exam_id);
        $this->db->limit(1);
        $query = $this->db->get('scl_student_result');
        return $query->result();
    }

    public function deleteResultSummary($school_id, $exam_id) {
        $result_details = $this->getResultDetails($school_id, $exam_id);
        if($result_details) {
            foreach($result_details as $details) {
                $this->db->where('school_id', $school_id);
                $this->db->where('class_name_id', $details->class_name_id);
                $this->db->where('section_id', $details->section_id);
                return $this->db->delete('scl_result_summary');
            }
        }
    }

    public function deleteStudentResult($school_id, $exam_id) {
        $this->db->where('school_id', $school_id);
        $this->db->where('exam_id', $exam_id);
        return $this->db->delete('scl_student_result');
    }

}