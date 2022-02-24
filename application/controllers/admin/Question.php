<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model(['exam_model', 'question_model', 'option_model']);

		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 1)
			redirect('login');
		$this->user_id = $this->session->userdata('user_id');
	}

	public function validate_user_data()
	{
		$validations = array(
			array(
				'field' => 'options[o_value][]',
				'label' => 'Option',
				'rules' => 'required|trim',
			),
			array(
				'field' => 'options[o_correct]',
				'label' => 'Correct Option',
				'rules' => 'required',
			),
		);

		$this->form_validation->set_rules($validations);
		$this->form_validation->set_rules('q_e_id', 		'Exam', 		'required');
		$this->form_validation->set_rules('q_question',	'Question', 'required');
	}


	public function index($exam_id = null)
	{
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

	private function create()
	{
		$data[] = "";

		$this->validate_user_data();
		$q_id = $this->input->post('q_id');

		$data['exam_list'] = $this->exam_model->read_as_list();
		$data['input'] = (object) $postData = [
			'q_id' 					=> isset($q_id) ? $q_id : null,
			'q_e_id'				=> $this->input->post('q_e_id'),
			'q_question'		=> $this->input->post('q_question'),
			'q_doc'					=> date('Y-m-d H:m:s'),
			'q_dou'					=> empty($q_id) ? null : date('Y-m-d H:m:s'),
			'q_status'			=> 1 //$this->input->post('exam_end_date'),
		];

		//Full texts 	q_id	q_e_id q_question	q_doc	q_dou	q_status

		/*-----------CHECK ID -----------*/
		if (empty($q_id)) {
			/*-----------CREATE A NEW RECORD-----------*/
			if ($this->form_validation->run() === true) {
				if ($this->question_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', 'Save Successfully');
					redirect('admin/question/index');
				} else {
					#set exception message
					$this->session->set_flashdata('exception', 'Please Try Againmmmm');
					redirect('admin/question/create');
				}
			} else {
				#------------- Default Form Section Display ---------#
				$data['contents'] = $this->load->view("admin/question/add_question_form", $data, true);
				$this->load->view("admin/home/layout/main_wrapper_view", $data);
			}
		} else {
			/*-----------UPDATE A RECORD-----------*/
			if ($this->form_validation->run() === true) {
				if ($this->question_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', 'Update Successfully');
				} else {
					#set exception message
					$this->session->set_flashdata('exception', 'Please Try Again');
				}
				redirect('admin/question/edit/' . $q_id);
			} else {
				#set exception message
				$this->session->set_flashdata('exception', 'Please Try Again');
				redirect('admin/question/edit/' . $q_id);
			}
		}
	}

	# used functional
	public function edit($q_id = null)
	{
		if (empty($q_id)) {
			redirect('admin/question/create');
		}
		#-------------------------------#
		$data['input']	= $this->question_model->read_by_id($q_id);
		$data['exam_list'] = $this->exam_model->read_as_list();
		$data['questions'] = $this->question_model->read_by_exam($this->session->userdata('q_e_id'));
		$data['input_options'] = $this->option_model->read_options_by_question_id_for_edit($q_id);

		// echo "<pre class='offset-sm-3 mt-5' >";
		// print_r($_POST);
		// print_r($data['input']);
		// print_r($data['input_options']);
		// echo "</pre>";

		$data['contents'] = $this->load->view('admin/question/question_view', $data, true);
		$this->load->view('admin/home/layout/main_wrapper_view', $data);
	}

	# Used
	public function delete($q_id)
	{
		$this->db->trans_begin();

		$this->option_model->delete_option_by_question_id($q_id);
		$this->question_model->delete($q_id);
		// if ($this->option_model->delete_option_by_question_id($q_id) && $this->question_model->delete($q_id)) {
		// 	$this->session->set_flashdata('message', 'Delete Successfully');
		// } else {
		// 	$this->session->set_flashdata('exception', 'Please Try Again');
		// }

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('exception', 'Please Try Again');
		} else {
			$this->db->trans_commit();
			$this->session->set_flashdata('message', 'Delete Successfully');
		}
		redirect('admin/question/index');
	}


	public function fetch_questio_options()
	{
		$data['options'] = $this->option_model->read_options_by_q_id($this->input->get('q_id'));
		$this->load->view('admin/option/view_option_ajaz', $data);
		//print_r($data);
	}
}
