<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave extends CI_Controller
{
  private $user_id;

  public function __construct()
  {
    parent::__construct();

    $this->load->model(array(
      'common_model',
      'faculty/faculty_model' => 'f_model',
      'faculty/leave_status_model' => 'ls_model',
      'faculty/leave_type_model' => 'lt_model',
      'faculty/leave_model' => 'leave_model',
      'faculty/leave_type_designation_model' => 'ltdm_model'
    ));

    if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 2)
      redirect('login');
    $this->user_id = $this->session->userdata('user_id');
  }

  public function index()
  {
    $leave_id = $this->input->post('l_id');
    $full_or_half_day = $this->input->post('l_is_half_day');
    $first_or_second_half = $this->input->post('l_first_or_second_half');
    $data['leave_statistics_by_status'] = $this->leave_model->get_toal_leaves_by_status_by_user_id($this->user_id);


    // print_r($data);
    $data['full_half_list'] = [
      'full_day' => 'Full Day',
      'half_day' => 'Half Day',
    ];
    $data['first_second_list'] = [
      '' => 'N/A',
      'first_half' => 'First Half',
      'second_half' => 'Second Half',
    ];
    #----------- Validation ----------------#
    {
      $this->form_validation->set_rules('l_leave_type_id', ('Time Of Type'),  'required');
      $this->form_validation->set_rules('l_from_date', ('From Date'),  'required');
      $this->form_validation->set_rules('l_reason', ('Reason'),  'required');
      if ($full_or_half_day == 'full_day') {
        $this->form_validation->set_rules('l_to_date', ('To Date'),    'required');
      }
      if ($full_or_half_day == 'half_day') {
        $this->form_validation->set_rules('l_first_or_second_half', ('First / Second Half'),  'required');
      }
      // $this->form_validation->set_rules('l_reason', ('Reason'),  'required');
      // $this->form_validation->set_rules('l_document', ('Document'),  'required');
    }

    #---------- Upload Document --------------#
    //picture upload
    $upload_config = [
      'allowed_types' => 'jpg|png|jpeg|doc|docx',
      'max_filename'  => 5,
      'overwrite'     => false,
      'max_size'      => '2000',
      // 'maintain_ratio' => true,
      // 'encrypt_name'  => false,
      'remove_spaces' => true,
      'file_ext_tolower' => true
    ];

    $picture = $this->fileupload->do_upload(
      'uploads/faculty/leave/',
      'l_document',
      $upload_config
    );

    // if picture is uploaded then resize the picture
    // if ($picture !== false && $picture != null) {
    //   $this->fileupload->do_resize(
    //     $picture,
    //     200,
    //     200
    //   );
    // }
    //if picture is not uploaded
    if ($picture === false) {
      // print_r($this->upload->display_errors())
      $this->session->set_flashdata('exception', ($this->upload->display_errors()));
    }
    #-------------------------------# 

    #----------- Input Data ----------------#
    $data['input'] = (object) $postDataInp = array(
      'l_id'                    => $this->input->post('l_id'),
      'l_leave_type_id'         => $this->input->post('l_leave_type_id'),
      'l_user_id'               => $this->session->userdata('user_id'),
      'l_applied_date'          => date('Y-m-d H:m:s'),
      'l_from_date'             => $this->input->post('l_from_date'),
      'l_to_date'               => ($full_or_half_day == 'half_day') ? $this->input->post('l_from_date') : $this->input->post('l_to_date'),
      'l_is_half_day'           => $full_or_half_day,
      'l_first_or_second_half'  => ($full_or_half_day == 'half_day') ? $first_or_second_half : null,
      'l_reason'                => $this->input->post('l_reason'),
      'l_document'              => $picture ?? $this->input->post('old_l_document') ?? null,
      'l_status'                => 1,
    );

    /*-----------CHECK ID -----------*/
    if (empty($leave_id)) {
      /*-----------CREATE A NEW RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->leave_model->create($postDataInp)) {
          #set success message
          $this->session->set_flashdata('message', ('Leave applied successfully.'));
          redirect('faculty/leave/index');
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
          redirect('faculty/leave/index');
        }
      } else {
        #------------- Default Form Section Display ---------#
        $data['title'] = ('Leave | Time Off');
        $data['subtitle'] = ('Add Time Off Request');
        $data['user_role_list'] = $this->common_model->get_user_roles();

        // $data['leave_types_list'] = $this->lt_model->read_as_list();
        $user_desg = $this->session->userdata('user_desg');
        $data['leave_types_list'] = $this->ltdm_model->read_leave_type_by_designation($user_desg);
        $data['leave_status_list'] = $this->ls_model->read_as_list();
        $data['leaves'] = $this->leave_model->read_with_join_by_faculty_id($this->user_id);

        $data['contents'] = $this->load->view('faculty/leave/form', $data, true);
        $this->load->view('faculty/layout/wrapper', $data);
      }
    } else {
      /*-----------UPDATE A RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->leave_model->update($postDataInp)) {
          #set success message
          $this->session->set_flashdata('message', ('update_successfully'));
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
        }
        // redirect('faculty/leave/edit/' . $postDataInp['l_id']);
        redirect('faculty/leave/index');
      } else {
        #set exception message
        $this->session->set_flashdata('exception', ('please_try_again') . "" . validation_errors());
        redirect('faculty/leave/edit/' . $postDataInp['l_id']);
      }
    }
  }

  # used functional
  public function edit($l_id = null)
  {
    if (empty($l_id)) {
      redirect('faculty/leave/create');
    }
    $data['title'] = ('Leave | Time Off');
    $data['subtitle'] = ('Add Time Off Request');
    $data['user_role_list'] = $this->common_model->get_user_roles();
    $data['leave_statistics_by_status'] = $this->leave_model->get_toal_leaves_by_status_by_user_id($this->user_id);

    $data['full_half_list'] = [
      'full_day' => 'Full Day',
      'half_day' => 'Half Day',
    ];
    $data['first_second_list'] = [
      '' => 'N/A',
      'first_half' => 'First Half',
      'second_half' => 'Second Half',
    ];
    $user_desg = $this->session->userdata('user_desg');

    $data['leave_types_list'] = $this->ltdm_model->read_leave_type_by_designation($user_desg);
    $data['leave_status_list'] = $this->ls_model->read_as_list();
    $data['leaves'] = $this->leave_model->read_with_join_by_faculty_id($this->user_id);

    #-------------------------------#
    $input     = $this->leave_model->read_by_id_as_obj($l_id);

    $data['input'] = (object) $postDataInp = array(
      'l_id'                    => $input->l_id,
      'l_leave_type_id'         => $input->l_leave_type_id,
      'l_user_id'               => $this->session->userdata('user_id'),
      'l_applied_date'          => date('Y-m-d H:m:s'),
      'l_from_date'             => date('Y-M-d', strtotime($input->l_from_date)),
      'l_to_date'               => date('Y-M-d', strtotime($input->l_to_date)),
      'l_is_half_day'           => $input->l_is_half_day,
      'l_first_or_second_half'  => $input->l_first_or_second_half,
      'l_reason'                => $input->l_reason,
      'l_document'              => $input->l_document,
      'l_status'                => $input->l_status,
    );

    $data['contents'] = $this->load->view('faculty/leave/form', $data, true);
    $this->load->view('faculty/layout/wrapper', $data);
  }

  # Not Used
  public function delete($l_id = null)
  {
    if (empty($l_id)) {
      redirect('faculty/leave/index');
    }
    // Check if leave is unapprove or pending.
    $input     = $this->leave_model->read_by_id_as_obj($l_id);

    if ($input->l_status == 1 && $this->leave_model->delete($l_id)) {
      $file = $input->l_document;
      if (file_exists($file)) {
        @unlink($file);
      }
      $this->session->set_flashdata('message', ('delete_successfully'));
    } else {
      $fk_check = $this->db->error();
      if (valArr($fk_check) && isset($fk_check['code']) && $fk_check['code'] == 1451) {
        $this->session->set_flashdata('exception', 'This label is used in some property(ies), please change/remove it before deleting.');
      } else {
        $this->session->set_flashdata('exception', ('please_try_again'));
      }
    }
    redirect('faculty/leave/index');
  }
}
