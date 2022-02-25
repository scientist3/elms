<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'setting_model',
			'common_model'
		));

		if (
			$this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 1
		)
			redirect('login');
	}

	public function index()
	{
		$data['title'] = ('Institution Setting');
		#-------------------------------#
		//check setting table row if not exists then insert a row
		$this->check_setting();
		#-------------------------------#
		$data['languageList'] = $this->languageList();
		$data['setting'] = $this->setting_model->read();
		$data['user_role_list'] = $this->common_model->get_user_roles();
		$data['contents'] = $this->load->view('setting', $data, true);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function create()
	{
		$data['title'] = ('Institution Setting');
		$data['user_role_list'] = $this->common_model->get_user_roles();
		#-------------------------------#
		$this->form_validation->set_rules('title', ('website_title'), 'required|max_length[50]');
		$this->form_validation->set_rules('description', ('address'), 'max_length[255]');
		$this->form_validation->set_rules('email', ('email'), 'max_length[100]|valid_email');
		$this->form_validation->set_rules('phone', ('phone'), 'max_length[20]');
		$this->form_validation->set_rules('language', ('language'), 'max_length[250]');
		$this->form_validation->set_rules('footer_text', ('footer_text'), 'max_length[255]');
		#-------------------------------#
		//logo upload
		$logo = $this->fileupload->do_upload(
			'uploads/site/logo/',
			'logo'
		);
		// if logo is uploaded then resize the logo
		if ($logo !== false && $logo != null) {
			$this->fileupload->do_resize(
				$logo,
				250,
				55
			);
		}
		//if logo is not uploaded
		if ($logo === false) {
			$this->session->set_flashdata('exception', ('invalid_logo'));
		}


		//favicon upload
		$favicon = $this->fileupload->do_upload(
			'uploads/site/logo/',
			'favicon'
		);
		// if favicon is uploaded then resize the favicon
		if ($favicon !== false && $favicon != null) {
			$this->fileupload->do_resize(
				$favicon,
				32,
				32
			);
		}
		//if favicon is not uploaded
		if ($favicon === false) {
			$this->session->set_flashdata('exception', ('invalid_favicon'));
		}
		#-------------------------------#

		$data['setting'] = (object)$postData = [
			'setting_id'  => $this->input->post('setting_id'),
			'title' 	  => $this->input->post('title'),
			'description' => $this->input->post('description', false),
			'email' 	  => $this->input->post('email'),
			'phone' 	  => $this->input->post('phone'),
			'logo' 	      => (!empty($logo) ? $logo : $this->input->post('old_logo')),
			'favicon' 	  => (!empty($favicon) ? $favicon : $this->input->post('old_favicon')),
			'language'    => $this->input->post('language'),
			'site_align'  => $this->input->post('site_align'),
			'footer_text' => $this->input->post('footer_text', false)
		];
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $setting_id then insert data
			if (empty($postData['setting_id'])) {
				if ($this->setting_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', ('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', ('please_try_again'));
				}
			} else {
				if ($this->setting_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', ('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', ('please_try_again'));
				}
			}

			//update session data
			$this->session->set_userdata([
				'title' 	  => $postData['title'],
				'address' 	  => $postData['description'],
				'email' 	  => $postData['email'],
				'phone' 	  => $postData['phone'],
				'logo' 		  => $postData['logo'],
				'favicon' 	  => $postData['favicon'],
				'language'    => $postData['language'],
				'footer_text' => $postData['footer_text'],
			]);

			redirect('setting');
		} else {
			$data['contents'] = $this->load->view('setting', $data, true);
			$this->load->view('admin/layout/wrapper', $data);
		}
	}

	//check setting table row if not exists then insert a row
	public function check_setting()
	{
		if ($this->db->count_all('setting') == 0) {
			$this->db->insert('setting', [
				'title' => 'Demo Hospital Limited',
				'description' => '123/A, Street, State-12345, Demo',
				'footer_text' => date('Y') . '&copy;Copyright. Designed By Mohammad Aamir',
			]);
		}
	}

	public function languageList()
	{
		if ($this->db->table_exists("language")) {
			$fields = $this->db->field_data("language");

			$i = 1;
			foreach ($fields as $field) {
				if ($i++ > 2)
					$result[$field->name] = ucfirst($field->name);
			}

			if (!empty($result))
				return $result;
		} else {
			return false;
		}
	}
}
