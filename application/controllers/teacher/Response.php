<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Response extends CI_Controller
{
  private $user_id;

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Kolkata");
    $this->load->model([
      'user_model',
      'exam_model',
      'question_model',
      'option_model',
      'response_model' => 'r_model'
    ]);

    if ($this->session->userdata('isLogIn') == false || $this->session->userdata('user_role') != 3)
      redirect('login');
    $this->user_id = $this->session->userdata('user_id');
  }


  public function index($exam_id = null, $student_id = null)
  {
    // Get the exam id
    $r_e_id = !empty($this->input->post('r_e_id')) ?
      $this->input->post('r_e_id') : (!empty($exam_id) ? $exam_id : $this->session->userdata('r_e_id'));

    // Store the exam in sessions
    $this->session->set_userdata('r_e_id', $r_e_id);

    // Get the Student Id
    $r_u_id = !empty($this->input->post('r_u_id')) ? $this->input->post('r_u_id') : (!empty($student_id) ? $student_id : $this->session->userdata('r_u_id'));
    // Prepare data
    $data['exam_id'] = $r_e_id;
    $data['student_id'] = $r_u_id;
    $data['exam_list'] = $this->exam_model->read_as_list_by_user($this->user_id);
    $data['question_list'] = $this->question_model->read_by_exam($r_e_id);
    $data['responses'] = $this->r_model->read_by_exam_by_student($r_e_id, $r_u_id);
    $data['student_list'] = $this->user_model->get_enrolled_student_list($r_e_id);

    $data['input'] = (object) $postDataQuestion = [
      'r_e_id'  => $r_e_id,
      'r_u_id'  => $r_u_id
    ];

    $data['contents'] = $this->load->view("teacher/response/response_view", $data, true);
    $this->load->view("teacher/home/layout/main_wrapper_view", $data);
    //}
  }
}
