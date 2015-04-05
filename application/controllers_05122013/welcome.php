<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('general_model', 'General_model', true); 
        $this->load->library('pagination');  
    }
	public function index()
	{ 
        $pageNo = 0;
        $data['showslider'] = 1;
        $data['comma_separated_leaving_from'] = $this->General_model->get_travellertype_list();
        $data['comma_separated_mytrip'] = $this->General_model->get_mytrip_list(); 
        $data['transportation'] = $this->General_model->get_mytrip_transportation_list(); 
        
        $data['flightList'] = $this->General_model->get_general_flight_list($pageNo);
        $data['mainContent']        = $this->load->view('home', $data, true); 
        $this->load->view('template', $data); 
	}
}