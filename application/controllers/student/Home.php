<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home  extends CI_Controller
{

	private $user_id;

	public function __construct()
	{
		parent::__construct();

		$this->load->model(['exam_model', 'student_exam_model' => 'se_exam']);
		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 2)
			redirect('login');
		$this->user_id = $this->session->userdata('user_id');
	}

	public function index()
	{
		$data['user'] = array();
		$data['total_applied'] = $this->se_exam->total_exams_applied_by_student($this->user_id);
		$data['total_attempted'] = $this->se_exam->total_exams_attempted_by_student($this->user_id);
		$data['todays_exam'] = $this->exam_model->read_todays_exam($this->user_id);
		dd($data);
		$data['contents'] = $this->load->view("student/home/Home_view", $data, true);
		$this->load->view("student/home/layout/main_wrapper_view", $data);
	}

	public function get_todays_exam()
	{
		$data['todays_exam'] = $this->exam_model->read_todays_exam($this->user_id);
		//dd($data);
		($this->load->view("student/home/part/todays_exam_part", $data));
	}
}
