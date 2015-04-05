<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        #$this->load->model('general_model', 'General_model', true); 
        $this->load->library('pagination');  
    }
	public function index()
	{       
            #$data['mainContent']        = $this->load->view('home', $data, true); 
            $this->load->view('template', $data); 
	}
}