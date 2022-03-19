<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home  extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model(['common_model', 'admin/leave_model' => 'l_model']);
		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 1)
			redirect('login');
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['user_role_list'] = $this->common_model->get_user_roles();
		$data['todays_pending_leaves'] = $this->l_model->get_todays_leaves_by_status_by_day([1], ['full_day', 'half_day']);
		$data['todays_approved_leaves'] = $this->l_model->get_todays_leaves_by_status_by_day([2], ['half_day']);
		$data['todays_approved_half_leaves'] = $this->l_model->get_todays_leaves_by_status_by_day([2], ['half_day']);

		$data['current_month'] = $this->l_model->get_current_month_leaves_by_leave_status();
		$data['current_year'] = $this->l_model->get_current_year_leaves_by_leave_status();

		// print_r($data);
		$data['contents'] = $this->load->view("admin/home/home_view", $data, true);
		$this->load->view("admin/layout/wrapper", $data);
	}
}
