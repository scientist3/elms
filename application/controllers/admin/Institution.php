<?php

use Carbon\Carbon;

defined('BASEPATH') or exit('No direct script access allowed');

class Institution extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model(['admin/Institution_model' => 'inst_model', 'common_model']);

		if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 1)
			redirect('login');
		$this->user_id = $this->session->userdata('user_id');
	}

	public function index()
	{
		$data['title'] = "Institution";
		$data['user_role_list'] = $this->common_model->get_user_roles();
		$data['institution'] = $this->inst_model->read();

		#----------- Validation ----------------#
		{
			$this->form_validation->set_rules('inst_name',   		'Institution Name',  'required|max_length[50]');
			$this->form_validation->set_rules('inst_phone_no', 	'Phone no',    'required');
			$this->form_validation->set_rules('inst_email_id', 	'Email',    'required');
		}
		// If submitted form then prepare the data
		if ($this->input->post("instiution_btn") == 'Submit') {
			$data['institution'] = (object) $postDataInp = array(
				"inst_id" 						=> $this->input->post('inst_id') ?? null,
				"inst_name" 					=> $this->input->post('inst_name'),
				"inst_phone_no" 			=> $this->input->post('inst_phone_no'),
				"inst_email_id" 			=> $this->input->post('inst_email_id'),
				"inst_logo" 					=> $this->input->post('existing_logo') ?? $data['institution']->inst_logo ?? null,
				// "inst_admin_user_id" 	=> $this->input->post('inst_admin_user_id'),
				// "inst_doc" 						=> $this->input->post('inst_doc'),
				"inst_dou" 						=> date('Y-m-d H:m:s'),
				"inst_status" 				=> 1,
			);

			if ($this->form_validation->run() === true) {
				if ($this->inst_model->update($postDataInp)) {
					#set success message
					$this->session->set_flashdata('message', ('Save Successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', ('Please Try Again'));
				}
				$this->session->set_userdata([
					'picture'       =>  $data['institution']->inst_logo ?? 'assetslte/images/noimage.png'
				]);
				redirect('admin/institution/index');
			} else {
				#------------- Default Form Section Display ---------#
				$data['contents'] = $this->load->view("admin/institution/index", $data, true);
				$this->load->view("admin/layout/wrapper", $data);
			}
		} else {
			$data['contents'] = $this->load->view("admin/institution/index", $data, true);
			$this->load->view("admin/layout/wrapper", $data);
		}
	}


	public function do_upload()
	{
		ini_set('memory_limit', '200M');
		ini_set('upload_max_filesize', '200M');
		ini_set('post_max_size', '200M');
		ini_set('max_input_time', 3600);
		ini_set('max_execution_time', 3600);

		if (($_SERVER['REQUEST_METHOD']) == "POST") {
			$filename = $_FILES['attach_file']['name'];
			$filename = strstr($filename, '.', true);
			// $email    = $this->session->userdata('email');
			// $filename = strstr($email, '@', true) . "_" . $filename;
			$filename = strtolower($filename);
			/*-----------------------------*/

			//$config['upload_path']   = './uploads/documnet/';
			// $pro = $this->input->post('doc_pro_id');
			// if (empty($pro)) {
			// 	$data['exception'] = 'Please select project first. You documents will be saved according to project';
			// 	$data['status'] = false;
			// 	echo json_encode($data);
			// 	return;
			// }
			//folder upload
			$file_path = './uploads/institution/';
			if (!is_dir($file_path))
				mkdir($file_path, 0755, true);

			$config['upload_path'] = $file_path;
			//ends of folder upload 
			// $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|jpe|png';

			$config['max_size']      = 0;
			$config['max_width']     = 0;
			$config['max_height']    = 0;
			$config['file_ext_tolower'] = true;
			$config['file_name']     =  $filename;
			$config['overwrite']     = false;
			$this->load->library('upload', $config);

			$name = 'attach_file';
			if (!$this->upload->do_upload($name)) {
				$data['exception'] = $this->upload->display_errors();
				$data['status'] = false;
				echo json_encode($data);
			} else {
				$upload =  $this->upload->data();
				$data['message'] = "Upload Successfully";
				$data['filepath'] = $file_path . $upload['file_name'];
				$data['fullfilepath'] = base_url($data['filepath']);
				$data['filetype'] = substr($upload['file_ext'], 1);
				$data['status'] = true;
				echo json_encode($data);
			}
		}
	}
}
