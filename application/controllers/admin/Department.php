<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Department extends CI_Controller
{
  private $user_id;
  public function __construct()
  {
    parent::__construct();

    $this->load->model(array(
      'common_model',
      'admin/department_model' => 'dept_model'
    ));

    if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 1)
      redirect('login');
    $this->user_id = $this->session->userdata('user_id');
  }

  public function index()
  {
    $this->create();
  }

  # used functional
  public function create()
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
        if ($this->dept_model->create($postDataUser)) {
          #set success message
          $this->session->set_flashdata('message', ('save_successfully'));
          redirect('admin/department/create');
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
          redirect('admin/department/create');
        }
      } else {
        #------------- Default Form Section Display ---------#
        $data['title'] = ('Add View Department');
        $data['subtitle'] = ('Add Department');
        $data['user_role_list'] = $this->common_model->get_user_roles();
        $data['departments'] = $this->dept_model->read();
        $data['contents'] = $this->load->view('admin/department/form', $data, true);
        $this->load->view('admin/layout/wrapper', $data);
      }
    } else {
      /*-----------UPDATE A RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->dept_model->update($postDataUser)) {
          #set success message
          $this->session->set_flashdata('message', ('update_successfully'));
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
        }
        redirect('admin/department/edit/' . $postDataUser['dept_id']);
      } else {
        #set exception message
        $this->session->set_flashdata('exception', ('please_try_again') . "" . validation_errors());
        redirect('admin/department/edit/' . $postDataUser['dept_id']);
      }
    }
  }

  # used functional
  public function edit($dept_id = null)
  {
    if (empty($dept_id)) {
      redirect('admin/department/create');
    }
    $data['title'] = ('Add View Department');
    $data['subtitle'] = ('Add Department');
    $data['user_role_list'] = $this->common_model->get_user_roles();

    #-------------------------------#
    $input     = $this->dept_model->read_by_id_as_obj($dept_id);

    $data['input'] = (object)$postDataInp = array(
      'dept_id'     => $input->dept_id,
      'dept_name'   => $input->dept_name,
      'dept_status' => $input->dept_status
    );
    $data['departments'] = $this->dept_model->read();
    $data['contents'] = $this->load->view('admin/department/form', $data, true);
    $this->load->view('admin/layout/wrapper', $data);
  }

  # Used
  public function delete($dept_id = null)
  {
    if (empty($dept_id)) {
      redirect('admin/department/create');
    }
    if ($this->dept_model->delete($dept_id)) {
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
    redirect('admin/department/create');
  }
}
