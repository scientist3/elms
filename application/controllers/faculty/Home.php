<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home  extends CI_Controller
{
	private $is_edit_enabled = 0;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 2)
			redirect('login');
		$this->load->model(array(
			'common_model',
			'user_model',
			'faculty/leave_model',
			'faculty/designation_model' => 'desg_model',
			'faculty/department_model' => 'dept_model',
			'category_model' => 'c_model',
		));

		// print_r($_SESSION);
		$this->user_id = $this->session->userdata('user_id');
		// $this->is_edit_enabled = 0;
		// $this->session->set_userdata('is_edit_enabled', 1);
		$this->is_edit_enabled = $this->session->userdata('is_edit_enabled');
	}

	public function index()
	{
		// Force to update profile first
		if ($this->is_edit_enabled == 1) {
			$this->session->set_flashdata('exception', ('Please update your profile first'));
			redirect('faculty/home/profile');     // Faculty
		}
		$data['title'] = 'Faculty Dashboard';
		// $data['title'] = 'Faculty Dashboard - Report (' . date('Y') . ')';

		$data['leave_statistics_by_status'] = $this->leave_model->get_toal_leaves_by_status_by_user_id($this->user_id);
		$data['user_role_list'] = $this->common_model->get_user_roles();
		$data['contents'] = $this->load->view("faculty/home/home_view", $data, true);
		$this->load->view("faculty/layout/wrapper", $data);
	}

	public function profile()
	{
		if ($this->session->userdata('isLogIn') == false)
			redirect('login');
		$data['title'] = ('Faculty Profile');
		#------------------------------# 
		$user_id = $this->session->userdata('user_id');
		$data['user']    					= $this->user_model->profile($user_id);
		$data['user_role_list'] 	= $this->common_model->get_user_roles();
		$data['designation_list'] = $this->desg_model->read_as_list();
		$data['department_list'] 	= $this->dept_model->read_as_list();
		$data['category_list'] 		= $this->c_model->read_as_list();

		// show($data);
		$data['contents'] = $this->load->view('faculty/profile', $data, true);
		$this->load->view('faculty/layout/wrapper', $data);
	}

	public function email_check($email, $user_id)
	{
		$emailExists = $this->db->select('u_email')
			->where('u_email', $email)
			->where_not_in('u_id', $user_id)
			->get('user_tbl')
			->num_rows();

		if ($emailExists > 0) {
			$this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
			return false;
		} else {
			return true;
		}
	}

	// Profile Edit
	public function form()
	{
		if ($this->session->userdata('isLogIn') == false)
			redirect('login');

		$data['title'] = ('edit_profile');
		$user_id = $this->session->userdata('user_id');
		#------------- Validation For edit all ------------------#
		if ($this->is_edit_enabled == 1) {
			$this->form_validation->set_rules('u_name', ('Name'), 'required|max_length[50]');
			$this->form_validation->set_rules('u_desg_id', ('Designation'),  'required');
			$this->form_validation->set_rules('u_dept_id', ('Department'),   'required');
			$this->form_validation->set_rules('u_category', ('Category'),   'required');
			$this->form_validation->set_rules('u_qualification', ('Qualification'),   'required');
			$this->form_validation->set_rules('u_d_o_appointment', ('Appointment Date'),   'required');
			$this->form_validation->set_rules('u_first_place_of_posting', ('First Posting'),   'required');
			$this->form_validation->set_rules('u_d_o_app_at_spc', ('Date of Posting at SP College'),   'required');
			$this->form_validation->set_rules('u_d_o_last_promotion', ('Date of last promotion'),   'required');
		}

		#------------- Validation For Normal case ------------------#
		$this->form_validation->set_rules('u_email', ('Email'), "required|max_length[50]|valid_email|callback_email_check[$user_id]");
		//$this->form_validation->set_rules('password', ('password'), 'required|max_length[32]|md5');
		$this->form_validation->set_rules('u_mobile', ('Mobile'), 'required|max_length[20]');
		$this->form_validation->set_rules('u_adress', ('Address'), 'required');

		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'uploads/faculty/profilepic/',
			'picture'
		);
		// if picture is uploaded then resize the picture
		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize(
				$picture,
				200,
				200
			);
		}
		//if picture is not uploaded
		if ($picture === false) {
			$this->session->set_flashdata('exception', ('invalid_picture'));
		}
		#----------------Prepare data for full edit---------------# 
		if ($this->is_edit_enabled == 1) {
			$data['user'] = (object)$postData = [
				'u_id'						=> $this->input->post('u_id', true),
				'u_name'					=> $this->input->post('u_name', true),
				'u_desg_id'				=> $this->input->post('u_desg_id', true),
				'u_dept_id'				=> $this->input->post('u_dept_id', true),
				'u_category'    	=> $this->input->post('u_category', true),
				'u_qualification'	=> $this->input->post('u_qualification', true),
				'u_mobile'       	=> $this->input->post('u_mobile', true),
				'u_email'        	=> $this->input->post('u_email', true),
				'u_password'     	=> (!empty($this->input->post('u_password', true))) ? md5($this->input->post('u_password', true)) : $this->input->post('old_password', true),
				'u_picture'      	=> (!empty($picture) ? $picture : $this->input->post('old_picture')),
				'u_adress'   			=> $this->input->post('u_adress', true),
				'u_d_o_appointment'          => $this->input->post('u_d_o_appointment', true),
				'u_first_place_of_posting'          => $this->input->post('u_first_place_of_posting', true),
				'u_d_o_app_at_spc'          => $this->input->post('u_d_o_app_at_spc', true),
				'u_d_o_last_promotion'          => $this->input->post('u_d_o_last_promotion', true),
				'u_enable_edits'   => 0,
				'u_dou'  					=> date('Y-m-d H:m:s'),
			];
		} else {
			$data['user'] = (object)$postData = [
				'u_id'						=> $this->input->post('u_id', true),
				'u_mobile'				=> $this->input->post('u_mobile', true),
				'u_email'					=> $this->input->post('u_email', true),
				'u_password'			=> (!empty($this->input->post('u_password', true))) ? md5($this->input->post('u_password', true)) : $this->input->post('old_password', true),
				'u_picture'				=> (!empty($picture) ? $picture : $this->input->post('old_picture')),
				'u_adress'				=> $this->input->post('u_adress', true),
				'u_dou'						=> date('Y-m-d H:m:s'),
			];
		}
		// print_r($_SESSION);
		// die();
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			if ($this->user_model->update($postData)) {
				#set success message
				$this->session->set_flashdata('message', ('update_successfully'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', ('please_try_again'));
			}

			//update profile picture
			if ($postData['u_id'] == $this->session->userdata('user_id')) {
				$this->session->set_userdata([
					// Fixme: Refector
					'picture'   => !empty($postData['u_picture']) ? $postData['u_picture'] : 'uploads/noimageold.png',
					'is_edit_enabled'  => 0
				]);
			}
			// show($_SESSION);
			redirect('faculty/home/profile/');
		} else {
			$user_id = $this->session->userdata('user_id');
			$data['user'] = $this->user_model->profile($user_id);
			$data['user_role_list'] = $this->common_model->get_user_roles();
			$data['designation_list'] = $this->desg_model->read_as_list();
			$data['department_list'] = $this->dept_model->read_as_list();
			$data['category_list'] 		= $this->c_model->read_as_list();

			$data['contents'] = $this->load->view('faculty/profile', $data, true);
			$this->load->view('faculty/layout/wrapper', $data);
		}
	}
}
