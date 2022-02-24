<?php

use Carbon\Carbon;

defined('BASEPATH') or exit('No direct script access allowed');

class Exam extends CI_Controller
{
	private $user_id;
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model(['exam_model']);

		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 3)
			redirect('login');
		$this->user_id = $this->session->userdata('user_id');
	}

	public function index()
	{
		$data['user'] = array();
		$data['exams'] = $this->exam_model->read_by_user($this->user_id);
		$data['contents'] = $this->load->view("teacher/exam/exam_view", $data, true);
		$this->load->view("teacher/home/layout/main_wrapper_view", $data);
	}



	public function create()
	{
		$this->validate_user_data();
		$e_id = $this->input->post('e_id');


		$curDateTime = Carbon::today("Asia/Kolkata");

		// dd(Carbon::parse($this->input->post('e_reg_start'))->toDateTimeString());
		// dd($this->input->post('e_reg_start'));

		$e_reg_start = empty($this->input->post('e_reg_start')) ?
			Carbon::today("Asia/Kolkata")->hours(9)->minutes(0)->toDateTimeString() :
			$this->input->post('e_reg_start');
		// Carbon::parse($this->input->post('e_reg_start'))->toDateTimeString();

		$e_reg_end = empty($this->input->post('e_reg_end')) ?
			Carbon::today("Asia/Kolkata")->hours(9)->minutes(0)->toDateTimeString() :
			$this->input->post('e_reg_end');
		// Carbon::parse($this->input->post('e_reg_end'))->toDateTimeString();


		$e_exam_start = empty($this->input->post('e_exam_start')) ?
			Carbon::today("Asia/Kolkata")->addDays(14)->hours(10)->minutes(0)->toDateTimeString() :
			$this->input->post('e_exam_start');
		// Carbon::parse($this->input->post('e_exam_start'))->toDateTimeString();

		$e_exam_end = empty($this->input->post('e_exam_end')) ?
			Carbon::today("Asia/Kolkata")->addDays(14)->hours(10)->minutes(30)->toDateTimeString() :
			$this->input->post('e_exam_end');
		// Carbon::parse($this->input->post('e_exam_end'))->toDateTimeString();


		$data['input'] = (object) $postData = [
			'e_id' 					=> isset($e_id) ? $e_id : null,
			'e_name'				=> $this->input->post('e_name'),
			'e_reg_start' 	=> $e_reg_start,
			'e_reg_end' 		=> $e_reg_end,
			'e_exam_start'	=> $e_exam_start,
			'e_exam_end'		=> $e_exam_end,
			'e_doc'					=> $curDateTime->format("Y-m-d H:m A"),
			'e_dou'					=> empty($e_id) ? null : $curDateTime->format("Y-m-d H:m A"),
			'e_created_by'	=> $this->session->userdata('user_id'),
			'e_status'			=> 1 //$this->input->post('exam_end_date'),
		];

		$data['exams'] = $this->exam_model->read();
		/*-----------CHECK ID -----------*/
		if (empty($e_id)) {
			/*-----------CREATE A NEW RECORD-----------*/
			if ($this->form_validation->run() === true) {
				if ($this->exam_model->create($postData)) {
					$q_id = $this->db->insert_id();
					#set success message
					$this->session->set_flashdata('message', 'Save Successfully');
					redirect('teacher/question/index/' . $q_id);
				} else {
					#set exception message
					$this->session->set_flashdata('exception', 'Please Try Again');
					redirect('teacher/exam/create');
				}
			} else {
				#------------- Default Form Section Display ---------#
				$data['contents'] = $this->load->view("teacher/exam/add_exam_form", $data, true);
				$this->load->view("teacher/home/layout/main_wrapper_view", $data);
			}
		} else {
			/*-----------UPDATE A RECORD-----------*/
			if ($this->form_validation->run() === true) {
				if ($this->exam_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', 'Update Successfully');
				} else {
					#set exception message
					$this->session->set_flashdata('exception', 'Please Try Again');
				}
				$this->edit($e_id);
			} else {
				#set exception message
				$this->session->set_flashdata('exception', 'Please Try Againnn');
				$this->edit($e_id);
			}
		}
	}

	# used functional
	public function edit($e_id = null)
	{
		if (empty($e_id)) {
			redirect('teacher/exam/create');
		}
		#-------------------------------#
		$data['input']	= $this->exam_model->read_by_id($e_id);

		$data['contents'] = $this->load->view('teacher/exam/add_exam_form', $data, true);
		$this->load->view('teacher/home/layout/main_wrapper_view', $data);
	}

	# Used
	public function delete($e_id)
	{
		if ($this->exam_model->delete($e_id)) {
			$this->session->set_flashdata('message', 'Delete Successfully');
		} else {
			$this->session->set_flashdata('exception', 'Please Try Again');
		}
		redirect('teacher/exam/index');
	}

	public function validate_user_data()
	{
		$this->form_validation->set_rules('e_name', 'Exam Name', 'required');
		$this->form_validation->set_rules('e_reg_start', 'Regisration start date', 'required|callback_isDate');
		$this->form_validation->set_rules('e_reg_end', 'Registration end date', 'required|callback_isRegEndGreaterThan[' . $this->input->post("e_reg_start") . ']');
		$this->form_validation->set_rules('e_exam_start', 'Exam start date', 'required|callback_isDate|callback_isExamStartGreaterThanRegStart[' . $this->input->post("e_reg_end") . ']');
		$this->form_validation->set_rules('e_exam_end', 'Exam end date', 'required|callback_isExamEndGreaterThan[' . $this->input->post("e_exam_start") . ']');
	}

	public function isExamEndGreaterThan($end_date, $start_date)
	{
		try {
			$start_date = Carbon::parse($start_date);
			$end_date = Carbon::parse($end_date);
			if ($start_date->gte($end_date)) {
				$this->form_validation->set_message('isExamEndGreaterThan', 'The Examination Start and End must have some difference.');
				return false;
			}

			// if ($start_date->lte($end_date->addDays(1))) {
			// 	$this->form_validation->set_message('isExamEndGreaterThan', 'The {field} is greater then 1 days.');
			// 	return false;
			// }

			return true;
		} catch (Exception $e) {
			$this->form_validation->set_message('isExamEndGreaterThan', 'The {field} field must be a valid date');
			return false;
		}
	}

	public function isRegEndGreaterThan($end_date, $start_date)
	{
		try {
			$start_date = Carbon::parse($start_date);
			$end_date = Carbon::parse($end_date);
			// if ($start_date->addDays(5)->gt($end_date)) {
			// 	$this->form_validation->set_message('isRegEndGreaterThan', 'The Registration Start and End must have 5 days difference.');
			// 	return false;
			// }

			if ($start_date->gte($end_date)) {
				$this->form_validation->set_message('isRegEndGreaterThan', 'The Registration Start and End must have some difference.');
				return false;
			}
			return true;
		} catch (Exception $e) {
			$this->form_validation->set_message('isRegEndGreaterThan', 'The {field} field must be a valid date');
			return false;
		}
	}


	public function isExamStartGreaterThanRegStart($end_date, $start_date)
	{
		try {
			$start_date = Carbon::parse($start_date);
			$end_date = Carbon::parse($end_date);
			// if ($start_date->addDays(5)->gt($end_date)) {
			// 	$this->form_validation->set_message('isRegEndGreaterThan', 'The Registration Start and End must have 5 days difference.');
			// 	return false;
			// }

			if ($start_date->gte($end_date)) {
				$this->form_validation->set_message('isExamStartGreaterThanRegStart', 'The Examination start date must be greater then Registration end date');
				return false;
			}
			return true;
		} catch (Exception $e) {
			$this->form_validation->set_message('isExamStartGreaterThanRegStart', 'The {field} field must be a valid date');
			return false;
		}
	}
	public function isDate($date)
	{
		try {
			$resutlt = Carbon::parse($date);
			return true;
		} catch (Exception $e) {
			$this->form_validation->set_message('checkPastDate', 'The {field} field must be a valid date');
			return false;
		}
	}
}
