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
      'admin/faculty_model' => 'f_model',
      'admin/leave_status_model' => 'ls_model',
      'admin/leave_type_model' => 'lt_model',
      'admin/leave_model' => 'leave_model',
      'admin/leave_type_designation_model' => 'ltdm_model'
    ));

    if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 1)
      redirect('login');
    $this->user_id = $this->session->userdata('user_id');
  }

  public function index()
  {
    // $this->create();
    #------------- Default Form Section Display ---------#
    $data['title'] = ('Leave | Time Off');
    $data['subtitle'] = ('Add Time Off Request');
    $data['user_role_list'] = $this->common_model->get_user_roles();

    $data['leave_types_list'] = $this->lt_model->read_as_list();
    $data['leave_status_list'] = $this->ls_model->read_as_list();
    $data['leaves'] = $this->leave_model->read_with_join(array('l_status' => 1));
    // print_r($data);
    $data['contents'] = $this->load->view('admin/leave/form', $data, true);
    $this->load->view('admin/layout/wrapper', $data);
  }

  public function view($l_id, $user_id)
  {
    // $this->create();
    #------------- Default Form Section Display ---------#
    $data['title'] = ('Leave | Time Off');
    $data['subtitle'] = ('Add Time Off Request');
    $data['user_role_list'] = $this->common_model->get_user_roles();

    $data['faculty_details'] = (object) $this->f_model->read_by_id($user_id);

    $desg_id = $data['faculty_details']->u_desg_id;

    $data['leave_types_list'] = $this->ltdm_model->read_leave_type_by_designation($desg_id);
    $data['leave_status_list'] = $this->ls_model->read_as_list();
    $data['leave'] = $this->leave_model->read_with_join_by_id($l_id);

    $data['contents'] = $this->load->view('admin/leave/view', $data, true);
    $this->load->view('admin/layout/wrapper', $data);
  }
  # used functional
  private function create()
  {
    $dept_id = $this->input->post('dept_id');

    #----------- Validation ----------------#
    {
      $this->form_validation->set_rules('dept_name', ('name'),  'required|max_length[50]');
      $this->form_validation->set_rules('dept_status', ('status'),    'required');
    }



    $data['input'] = (object)$postDataInp = array(
      'dept_id'     => $this->input->post('dept_id'),
      'dept_name'   => $this->input->post('dept_name'),
      'dept_status' => $this->input->post('dept_status')
    );

    $input = $data['input'];
    #----------------- User Object -------------#
    $data['user'] = (object)$postDataUser = array(
      'dept_id'     => $input->dept_id,
      'dept_name'   => $input->dept_name,
      'dept_status' => $input->dept_status
    );
    #----------------- Location Object -------------#

    /*-----------CHECK ID -----------*/
    if (empty($dept_id)) {
      /*-----------CREATE A NEW RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->leave_model->create($postDataUser)) {
          #set success message
          $this->session->set_flashdata('message', ('save_successfully'));
          redirect('admin/leave/create');
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
          redirect('admin/leave/create');
        }
      } else {
        #------------- Default Form Section Display ---------#
        $data['title'] = ('Leave | Time Off');
        $data['subtitle'] = ('Add Time Off Request');
        $data['user_role_list'] = $this->common_model->get_user_roles();

        $data['leave_types_list'] = $this->lt_model->read_as_list();
        $data['leave_status_list'] = $this->ls_model->read_as_list();
        $data['leaves'] = $this->leave_model->read_with_join();
        // print_r($data);
        $data['contents'] = $this->load->view('admin/leave/form', $data, true);
        $this->load->view('admin/layout/wrapper', $data);
      }
    } else {
      /*-----------UPDATE A RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->leave_model->update($postDataUser)) {
          #set success message
          $this->session->set_flashdata('message', ('update_successfully'));
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
        }
        redirect('admin/leave/edit/' . $postDataUser['dept_id']);
      } else {
        #set exception message
        $this->session->set_flashdata('exception', ('please_try_again') . "" . validation_errors());
        redirect('admin/leave/edit/' . $postDataUser['dept_id']);
      }
    }
  }

  public function update()
  {
    $l_id = $this->input->post('l_id');
    $user_id = $this->input->post('l_user_id');

    $postDataInp = [
      'l_id'      => $this->input->post('l_id'),
      'l_status'  => $this->input->post('l_status'),
      'l_comments' => $this->input->post('l_comments')
    ];

    if ($this->leave_model->update($postDataInp)) {
      $this->session->set_flashdata('message', ('update_successfully'));
    } else {
      $this->session->set_flashdata('exception', ('please_try_again'));
    }
    // redirect('admin/leave/view/' . $l_id . '/' . $user_id);
    redirect('admin/leave/index');
  }
  # Not used functional
  private function edit($dept_id = null)
  {
    if (empty($dept_id)) {
      redirect('admin/leave/create');
    }
    $data['title'] = ('Add View leave');
    $data['subtitle'] = ('Add leave');
    $data['user_role_list'] = $this->common_model->get_user_roles();

    #-------------------------------#
    $input     = $this->leave_model->read_by_id_as_obj($dept_id);

    $data['input'] = (object)$postDataInp = array(
      'dept_id'     => $input->dept_id,
      'dept_name'   => $input->dept_name,
      'dept_status' => $input->dept_status
    );
    $data['leaves'] = $this->leave_model->read();
    $data['contents'] = $this->load->view('admin/leave/form', $data, true);
    $this->load->view('admin/layout/wrapper', $data);
  }

  # Not Used
  public function delete($dept_id = null)
  {
    if (empty($dept_id)) {
      redirect('admin/leave/create');
    }
    if ($this->leave_model->delete($dept_id)) {
      // $this->location_model->delete($loc_id);
      $this->session->set_flashdata('message', ('delete_successfully'));
    } else {
      $fk_check = $this->db->error();
      if (valArr($fk_check) && isset($fk_check['code']) && $fk_check['code'] == 1451) {
        $this->session->set_flashdata('exception', 'This label is used in some property(ies), please change/remove it before deleting.');
      } else {
        $this->session->set_flashdata('exception', ('please_try_again'));
      }
    }
    redirect('admin/leave/create');
  }
}
