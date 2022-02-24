<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home  extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();

        //$this->load->model([]);
    }
	
	public function index()
	{
		$data['user'] = array();
		// $data['contents'] = $this->load->view("home/Home_view",$data,true);
		$this->load->view("teacher/home/layout/main_wrapper_view",$data);
    
	}
}