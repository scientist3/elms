<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home  extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 2)
			redirect('login');
		$this->load->model(array(
			'common_model',
			'user_model',
		));

		// print_r($_SESSION);
	}

	public function index()
	{
		$data['title'] = 'Faculty Home';
		$data['user'] = array();
		$data['user'] = array();
		$data['user_role_list'] = $this->common_model->get_user_roles();
		// $data['contents'] = $this->load->view("home/Home_view",$data,true);
		$this->load->view("faculty/layout/wrapper", $data);
	}

	public function profile()
	{
		if ($this->session->userdata('isLogIn') == false)
			redirect('login');
		$data['title'] = ('profile');
		#------------------------------# 
		$user_id = $this->session->userdata('user_id');
		$data['user']    = $this->user_model->profile($user_id);
		$data['user_role_list'] = $this->common_model->get_user_roles();

		// print_r($data['user']);
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
		#-------------------------------#
		$this->form_validation->set_rules('u_name', ('first_name'), 'required|max_length[50]');
		$this->form_validation->set_rules('u_email', ('email'), "required|max_length[50]|valid_email|callback_email_check[$user_id]");
		//$this->form_validation->set_rules('password', ('password'), 'required|max_length[32]|md5');
		$this->form_validation->set_rules('u_mobile', ('mobile'), 'required|max_length[20]');
		$this->form_validation->set_rules('u_adress', ('address'), 'required');

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
		#-------------------------------# 
		print_r($_POST);
		$data['user'] = (object)$postData = [
			'u_id'      => $this->input->post('u_id', true),
			'u_name'    => $this->input->post('u_name', true),
			// 'lastname'     => $this->input->post('lastname', true),
			//'designation'  => $this->input->post('designation',true),
			//'department_id' => $this->input->post('department_id',true),
			//'address'      => $this->input->post('address',true),
			//'phone'        => $this->input->post('phone',true),
			'u_mobile'       => $this->input->post('u_mobile', true),
			'u_email'        => $this->input->post('u_email', true),
			'u_password'     => (!empty($this->input->post('u_password', true))) ? md5($this->input->post('u_password', true)) : $this->input->post('old_password', true),
			//'short_biography' => $this->input->post('short_biography',true),
			'u_picture'      => (!empty($picture) ? $picture : $this->input->post('old_picture')),
			'u_adress'   => $this->input->post('u_adress', true),
			//'date_of_birth' => date('Y-m-d', strtotime($this->input->post('date_of_birth',true))),
			//'sex'          => $this->input->post('sex',true),
			//'blood_group'  => $this->input->post('blood_group',true),
			//'degree'       => $this->input->post('degree',true),
			//'created_by'   => $this->session->userdata('user_id'),
			'u_dou'  => date('Y-m-d H:m:s'),
			//'status'       => $this->input->post('status',true),
		];
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
			if ($postData['user_id'] == $this->session->userdata('user_id')) {
				$this->session->set_userdata([
					// Fixme: Refector
					'picture'   => !empty($postData['picture']) ? $postData['picture'] : 'uploads/noimageold.png',
					'fullname'  => $postData['firstname'] . ' ' . $postData['lastname']
				]);
			}
			redirect('faculty/home/profile/');
		} else {
			$user_id = $this->session->userdata('user_id');
			$data['user'] = $this->user_model->profile($user_id);
			$data['user_role_list'] = $this->common_model->get_user_roles();
			$data['contents'] = $this->load->view('faculty/profile', $data, true);
			$this->load->view('faculty/layout/wrapper', $data);
		}
	}
}
