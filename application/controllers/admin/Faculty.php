<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faculty extends CI_Controller
{
  private $user_id;
  public function __construct()
  {
    parent::__construct();

    $this->load->model(array(
      'common_model',
      'admin/faculty_model' => 'f_model',
      'admin/designation_model' => 'desg_model',
      'admin/department_model' => 'dept_model',
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
    $u_id = $this->input->post('u_id');

    #----------- Validation ----------------#
    {
      $this->form_validation->set_rules('u_name', ('Name'),         'required|max_length[50]');
      $this->form_validation->set_rules('u_desg_id', ('Designation'),  'required');
      $this->form_validation->set_rules('u_dept_id', ('Department'),   'required');
      $this->form_validation->set_rules('u_email', ('Email'),        'required');
      // $this->form_validation->set_rules('u_password', ('Password'),        'required');
      $this->form_validation->set_rules('u_status', ('Status'),        'required');
    }


    // <!-- u_id u_user_role u_desg_id u_u_id u_name u_username u_email u_password u_mobile u_adress u_picture u_user_approval u_doc u_dou u_status -->
    $password = $this->input->post('u_password');
    $old_password = $this->input->post('old_u_password');

    // javeed@gmail.com
    $data['input'] = (object)$postDataInp = array(
      'u_id'            => $this->input->post('u_id'),
      'u_user_role'     => 2,
      'u_dob'           => $this->input->post('u_dob'),
      'u_desg_id'       => $this->input->post('u_desg_id'),
      'u_dept_id'       => $this->input->post('u_dept_id'),
      'u_name'          => $this->input->post('u_name'),
      'u_email'         => $this->input->post('u_email'),
      'u_password'      => !empty($password) ? md5($password) : ((!empty($old_password)) ? $old_password : md5('faculty@123')),
      'u_mobile'        => $this->input->post('u_mobile'),
      'u_dou'           => date('Y-m-d H:m:s'),
      'u_status'        => $this->input->post('u_status'),
    );

    /*-----------CHECK ID -----------*/
    if (empty($u_id)) {
      /*-----------CREATE A NEW RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->f_model->create($postDataInp)) {
          #set success message
          $this->session->set_flashdata('message', ('save_successfully'));
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
        }
        redirect('admin/faculty/index');
      } else {
        #------------- Default Form Section Display ---------#
        $data['title'] = ('Add View Faculty');
        $data['subtitle'] = ('Add Faculty');
        $data['user_role_list'] = $this->common_model->get_user_roles();
        $data['designation_list'] = $this->desg_model->read_as_list();
        $data['department_list'] = $this->dept_model->read_as_list();
        $data['users'] = $this->f_model->read(2);
        $data['contents'] = $this->load->view('admin/faculty/form', $data, true);
        $this->load->view('admin/layout/wrapper', $data);
      }
    } else {
      /*-----------UPDATE A RECORD-----------*/
      if ($this->form_validation->run() === true) {
        if ($this->f_model->update($postDataInp)) {
          #set success message
          $this->session->set_flashdata('message', ('update_successfully'));
        } else {
          #set exception message
          $this->session->set_flashdata('exception', ('please_try_again'));
        }
        redirect('admin/faculty/edit/' . $postDataInp['u_id']);
      } else {
        #set exception message
        $this->session->set_flashdata('exception', ('please_try_again') . "" . validation_errors());
        redirect('admin/faculty/edit/' . $postDataInp['u_id']);
      }
    }
  }

  # used functional
  public function edit($u_id = null)
  {
    if (empty($u_id)) {
      redirect('admin/faculty/index');
    }
    $data['title'] = ('Add View faculty');
    $data['subtitle'] = ('Add faculty');
    $data['user_role_list'] = $this->common_model->get_user_roles();
    $data['designation_list'] = $this->desg_model->read_as_list();
    $data['department_list'] = $this->dept_model->read_as_list();
    $data['users'] = $this->f_model->read(2);

    #-------------------------------#
    $input     = $this->f_model->read_by_id_as_obj($u_id);

    $data['input'] = (object)$postDataInp = array(
      'u_id'            =>  $input->u_id,
      'u_dob'           =>  $input->u_dob,
      'u_user_role'     =>  $input->u_user_role,
      'u_desg_id'       =>  $input->u_desg_id,
      'u_dept_id'       =>  $input->u_dept_id,
      'u_name'          =>  $input->u_name,
      'u_email'         =>  $input->u_email,
      'u_password'      =>  $input->u_password,
      'u_mobile'        =>  $input->u_mobile,
      // 'u_adress'         $input->u_id => ,
      // 'u_picture'        $input->u_id => ,
      // 'u_user_approval'  $input->u_id => 1,
      // 'u_doc'            $input->u_id => ,
      'u_dou'           =>  $input->u_dou,
      'u_status'        =>  $input->u_status,
    );
    $data['contents'] = $this->load->view('admin/faculty/form', $data, true);
    $this->load->view('admin/layout/wrapper', $data);
  }

  # Used
  public function delete($u_id = null)
  {
    if (empty($u_id)) {
      redirect('admin/faculty/index');
    }
    if ($this->f_model->delete($u_id)) {
      // $this->location_model->delete($loc_id);
      $this->session->set_flashdata('message', ('delete_successfully'));
    } else {
      $fk_check = $this->db->error();
      if (valArr($fk_check) && isset($fk_check['code']) && $fk_check['code'] == 1451) {
        $this->session->set_flashdata('exception', 'This faculty is used in some setting, please change/remove it before deleting.');
      } else {
        $this->session->set_flashdata('exception', ('please_try_again'));
      }
    }
    redirect('admin/faculty/index');
  }
}
