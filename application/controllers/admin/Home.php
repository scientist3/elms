<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home  extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model(['common_model']);
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['user_role_list'] = $this->common_model->get_user_roles();
		// $data['contents'] = $this->load->view("admin/home/Home_view", $data, true);
		$this->load->view("admin/layout/wrapper", $data);
	}
}
