<?php

use Carbon\Carbon;
use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

class Exam extends CI_Controller
{
	private $user_id;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model(['exam_model', 'Student_exam_model' => 'se_model', 'question_model', 'option_model']);

		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 2)
			redirect('login');
		$this->user_id = $this->session->userdata('user_id');
	}

	public function index()
	{
		$data['user'] = array();
		// $data['applied_exams'] = $this->exam_model->read_applied_exams($this->user_id);
		// $data['approved_exams'] = $this->exam_model->read_approved_exams($this->user_id);
		$data['todays_exam'] = $this->exam_model->read_todays_exam($this->user_id);
		$data['upcomming_exams'] = $this->exam_model->read_upcomming_exams();
		$data['past_exams'] = $this->exam_model->read_past_exams();
		$data['all_exams'] = rekeyObject('e_id', $this->exam_model->read());
		$data['std_exam'] = $this->se_model->read_by_exam_by_student($this->user_id);
		$data['contents'] = $this->load->view("student/exam/exam_view", $data, true);
		$this->load->view("student/home/layout/main_wrapper_view", $data);
	}



	public function apply($exam_id = null)
	{
		if ($exam_id == null) {
			$this->session->set_flashdata('exception', 'Please Dont Try To Mess with URL. I know lot of things.');
			$this->index();
		} else {

			$data['exam'] 		= $this->exam_model->read_by_id($exam_id);
			$data['std_exam'] = $this->se_model->read_by_exam_by_student($this->user_id);
			//dd($data, false);
			$isValid = 1;

			if (!empty($data['exam']) && !empty($data['std_exam'])) {
				if (array_key_exists($data['exam']->e_id,	$data['std_exam'])) {
					$isValid = 0;
					$this->session->set_flashdata('exception', 'You have already applied.');
				}

				echo "<pre>";
				print_r($data['exam']);
				$obj_reg_start_date = Carbon::parse($data['exam']->e_reg_start, "Asia/Kolkata");
				$obj_reg_end_date = Carbon::parse($data['exam']->e_reg_end, "Asia/Kolkata");
				echo "</pre>";

				// echo Carbon::now("Asia/Kolkata")->gte($obj_reg_end_date) ? 'true' : 'false';
				// echo $obj_reg_end_date->gte(Carbon::now("Asia/Kolkata")) ? 'true' : 'false';

				// echo "Srttt : " . $obj_reg_start_date = Carbon::now("Asia/Kolkata")->subseconds(0);
				// echo "<br>";
				// echo "Now: " . Carbon::now("Asia/Kolkata");
				// echo "<br>";
				// echo "End : " . $obj_reg_end_date = Carbon::now("Asia/Kolkata")->addSeconds(1);
				// echo "<br>";

				echo isBetween(Carbon::now("Asia/Kolkata"), $obj_reg_start_date, $obj_reg_end_date) ? 'true' : 'false';

				// die();

				// if ($obj_reg_end_date->gte(Carbon::now("Asia/Kolkata"))) {

				if (!isBetween(Carbon::now("Asia/Kolkata"), $obj_reg_start_date, $obj_reg_end_date)) {

					$isValid = 0;
					$this->session->set_flashdata('exception', 'Either registration date is over or registration has not started yet.');
				}
			} else {
				$isValid = 0;
				$this->session->set_flashdata('exception', 'Please try again.');
			}

			if ($isValid) {
				$postData = [
					'se_u_id' 				=> $this->user_id,
					'se_e_id' 				=> $exam_id,
					'se_applied_date' => date("Y-m-d H:m:s"),
					'se_approved' 		=> 0,
					'se_approved_by' 	=> null,
					'se_attempted'		=> 0,
					'se_status'				=> 1
				];

				if ($this->se_model->create($postData)) {
					//$q_id = $this->db->insert_id();
					#set success message
					$this->session->set_flashdata('message', 'Applied Sucessfully. Waiting for the approval ');
				} else {
					#set exception message
					$this->session->set_flashdata('exception', 'Please Try Again');
				}
			}
			redirect('student/exam/index');
		}
	}

	public function take($exam_id)
	{
		if (empty($exam_id) || $exam_id == null) {
			$this->session->set_flashdata('exception', 'Please Dont Try To Mess with URL. I know lot of things.');
			$this->index();
		} else {
		}
		$data['contents'] = '';
		$data['exam_id'] = $exam_id;
		$data['questions'] = $this->question_model->read_by_exam($exam_id);
		dd($data);
		$data['contents'] = $this->load->view("student/exam/exam_take_view", $data, true);
		$this->load->view("student/home/layout/main_wrapper_view", $data);
	}
	public function submit_exam()
	{
		print_r($_POST);
		die();
		$q_id = $this->input->post('q_id');
		$q_e_id = !empty($this->input->post('q_e_id')) ? $this->input->post('q_e_id') : (!empty($exam_id) ? $exam_id : $this->session->userdata('q_e_id'));

		// Store the exam in sessions
		//if (isset($q_e_id)) {
		$this->session->set_userdata('q_e_id', $q_e_id);
		//}

		// Common functions
		$data['exam_list'] = $this->exam_model->read_as_list();
		// Getting user data
		$data['input'] = (object) $postDataQuestion = [
			'q_id' 				=> isset($q_id) ? $q_id : null,
			'q_e_id' 			=> $q_e_id,
			'q_question'	=> $this->input->post('q_question'),
			'q_doc'				=> date('Y-m-d H:m:s'),
			'q_dou'				=> empty($q_id) ? null : date('Y-m-d H:m:s'),
			'q_status'		=> 1

		];

		$data['input_options'] = $this->input->post('options');

		$data['options'] = array();

		$data['questions'] = $this->question_model->read_by_exam($q_e_id);
		if ($this->input->post('add_question') == 1) {

			// Validate the input data
			$this->validate_user_data();

			if (empty($q_id)) {
				if ($this->form_validation->run() === true) {
					if ($this->question_model->create($postDataQuestion)) {
						$question_id = $this->db->insert_id();
						$data['options'] = array();
						if (is_array($this->input->post('options')['o_value'])) {
							foreach ($this->input->post('options')['o_value'] as $key => $detail) {
								//if (!empty($this->input->post('additional')['title'][$key]) && !empty($this->input->post('additional')['value'][$key])) {
								$data['options'][] = [
									'o_q_id ' => $question_id,
									'o_value' => $detail,
									// 'o_correct' => $this->input->post("options"),
									'o_correct' => ($this->input->post("options")['o_correct'][0] == $key) ? 1 : 0,
								];
								//}
							}
						}
						$this->option_model->create_batch($data['options']);
						#set success message
						$this->session->set_flashdata('message', 'Save Successfully');
						redirect('admin/question/index',);
					} else {
						#set exception message
						$this->session->set_flashdata('exception', 'Please Try Again');
						redirect('admin/question/create');
					}
				} else {
					#------------- Default Form Section Display ---------#
					$data['contents'] = $this->load->view("admin/question/question_view", $data, true);
					$this->load->view("admin/home/layout/main_wrapper_view", $data);
				}
			} else {
				/*-----------UPDATE A RECORD-----------*/
				if ($this->form_validation->run() === true) {
					if ($this->question_model->update($postDataQuestion)) {

						$this->option_model->delete_option_by_question_id($q_id);
						$data['options'] = array();
						if (is_array($this->input->post('options')['o_value'])) {
							foreach ($this->input->post('options')['o_value'] as $key => $detail) {
								//if (!empty($this->input->post('additional')['title'][$key]) && !empty($this->input->post('additional')['value'][$key])) {
								$data['options'][] = [
									'o_q_id ' => $q_id,
									'o_value' => $detail,
									// 'o_correct' => $this->input->post("options"),
									'o_correct' => ($this->input->post("options")['o_correct'][0] == $key) ? 1 : 0,
								];
								//}
							}
						}
						$this->option_model->create_batch($data['options']);
						#set success message
						$this->session->set_flashdata('message', 'Update Successfully');
					} else {
						#set exception message
						$this->session->set_flashdata('exception', 'Please Try Again');
					}
					redirect('admin/question/');
				} else {
					#set exception message
					$this->session->set_flashdata('exception', 'Please Try Again');
					$this->edit($q_id);
				}
			}
		} else {
			#------------- Default Form Section Display ---------#
			$data['contents'] = $this->load->view("admin/question/question_view", $data, true);
			$this->load->view("admin/home/layout/main_wrapper_view", $data);
		}
	}
	# used functional
	public function edit($e_id = null)
	{
		if (empty($e_id)) {
			redirect('student/exam/create');
		}
		#-------------------------------#
		$data['input']	= $this->exam_model->read_by_id($e_id);

		$data['contents'] = $this->load->view('student/exam/add_exam_form', $data, true);
		$this->load->view('student/home/layout/main_wrapper_view', $data);
	}

	# Used
	public function delete($e_id)
	{
		if ($this->exam_model->delete($e_id)) {
			$this->session->set_flashdata('message', 'Delete Successfully');
		} else {
			$this->session->set_flashdata('exception', 'Please Try Again');
		}
		redirect('student/exam/index');
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

	public function get_current_exam_updates()
	{
		// $data['exam'] = '';
		$data['exam_id'] = $this->input->post('exam_id');
		$data['exam'] = $this->exam_model->read_by_id($data['exam_id']);

		$start  = \Carbon\Carbon::parse($data['exam']->e_exam_start,  "Asia/Kolkata")->toDateTimeString();
		$end    = \Carbon\Carbon::parse($data['exam']->e_exam_end,    "Asia/Kolkata")->toDateTimeString();
		$now    = \Carbon\Carbon::now("Asia/Kolkata")->toDateTimeString();

		$data1['status'] = '';
		$data1['time_left'] = '';

		if (isBetween($now, $start, $end)) {
			$data1['status'] = 'R';
			$data1['time_left'] = "Exam is going on ";
			$data1['time_left'] .= tdr($now, $end, ' left');
		} else if ($now < $start) {
			$data1['status'] = 'S';
			$data1['time_left'] = "Exam will Start in ";
			$data1['time_left'] .= tdr($start, $now, '.');
		} else if ($now > $end) {
			$data1['status'] = 'F';
			$data1['time_left'] = "Exam finished ";
			$data1['time_left'] .= tdr($now, $end, ' ago');
		}
		//dd($data);
		// $this->load->view("student/exam/parts/ongoing_exam_details_view", $data);
		echo json_encode($data1);
	}
}
