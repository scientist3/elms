<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Designation extends CI_Controller
{
  private $user_id;
  public function __construct()
  {
    parent::__construct();

    $this->load->model(array(
      'common_model',
      'admin/designation_model' => 'desg_model'
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
    $desg_id = $this->input->post('desg_id');

    #----------- Validation ----------------#
    {
      $this->form_validation->set_rules('desg_name', ('name'),  'required|max_length[50]');
      $this->form_validation->set_rules('desg_status', ('status'),    'required');
    }



    $data['input'] = (object)$postDataInp = array(
      'desg_id'     => $this->input->post('desg_id'),
      'desg_name'   => $this->input->post('desg_name'),
      'desg_status' => $this->input->post('desg_status')
    );

    $input = $data['input'];
    #----------------- User Object -------------#
    $data['user'] = (object)$postDataUser = array(
      'desg_id'     => $input->desg_id,
      'desg_name'   => $input->desg_name,
      'desg_status' => $input->desg_status
    );
    #----------------- Location Object -------------#

    /*-----------CHECK ID -----------*/
    if (empty($desg_id)) {
      /*-----------CREATE A NEW RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->desg_model->create($postDataUser)) {
          #set success message
          $this->session->set_flashdata('message', ('save_successfully'));
          redirect('admin/designation/create');
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
          redirect('admin/designation/create');
        }
      } else {
        #------------- Default Form Section Display ---------#
        $data['title'] = ('Add View designation');
        $data['subtitle'] = ('Add designation');
        $data['user_role_list'] = $this->common_model->get_user_roles();
        $data['designations'] = $this->desg_model->read();
        $data['contents'] = $this->load->view('admin/designation/form', $data, true);
        $this->load->view('admin/layout/wrapper', $data);
      }
    } else {
      /*-----------UPDATE A RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->desg_model->update($postDataUser)) {
          #set success message
          $this->session->set_flashdata('message', ('update_successfully'));
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
        }
        redirect('admin/designation/edit/' . $postDataUser['desg_id']);
      } else {
        #set exception message
        $this->session->set_flashdata('exception', ('please_try_again') . "" . validation_errors());
        redirect('admin/designation/edit/' . $postDataUser['desg_id']);
      }
    }
  }

  # used functional
  public function edit($desg_id = null)
  {
    if (empty($desg_id)) {
      redirect('admin/designation/create');
    }
    $data['title'] = ('Add View designation');
    $data['subtitle'] = ('Add designation');
    $data['user_role_list'] = $this->common_model->get_user_roles();

    #-------------------------------#
    $input     = $this->desg_model->read_by_id_as_obj($desg_id);

    $data['input'] = (object)$postDataInp = array(
      'desg_id'     => $input->desg_id,
      'desg_name'   => $input->desg_name,
      'desg_status' => $input->desg_status
    );
    $data['designations'] = $this->desg_model->read();
    $data['contents'] = $this->load->view('admin/designation/form', $data, true);
    $this->load->view('admin/layout/wrapper', $data);
  }

  # Used
  public function delete($desg_id = null)
  {
    if (empty($desg_id)) {
      redirect('admin/designation/create');
    }
    if ($this->desg_model->delete($desg_id)) {
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
    redirect('admin/designation/create');
  }
}
