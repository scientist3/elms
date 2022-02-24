<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Response_model extends CI_Model
{

  private $table = "response_tbl";

  public function read()
  {
    return $this->db->select('*')
      ->from($this->table)
      //->where('e_status', '1')
      ->get()
      ->result();

    // $list[''] = "Select User Role";//display('select_user_role');
    // if (!empty($result)) {
    // 	foreach ($result as $value) {
    // 		$list[$value->ur_id] = ($value->ur_name);
    // 	}
    // 	return $list;
    // } else {
    // 	return false;
    // }
  }



  public function create($data = [])
  {
    return $this->db->insert($this->table, $data);
  }


  public function create_batch($data = [])
  {
    return $this->db->insert_batch($this->table, $data);
  }

  public function read_by_id($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('q_id', $id)
      ->get()
      ->row();
  }

  public function read_response_by_question_id($q_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('o_q_id', $q_id)
      ->get()
      ->result();
  }

  public function read_by_exam_by_student($exam_id = null, $student_id = null)
  {
    if ($exam_id == null) {
      return false;
    }
    // Fetch the enrolled student for the particular exam Or filter by particular student.
    if ($student_id == null) {
      $enrolledStudent = $this->db->select('se_u_id')
        ->from('student_exam_tbl')
        ->where('se_e_id', $exam_id)
        ->get()
        ->result();
    } else {
      // Filter by student by exam
      $enrolledStudent = $this->db->select('se_u_id')
        ->from('student_exam_tbl')
        ->where('se_e_id', $exam_id)
        ->where('se_u_id', $student_id)
        ->get()
        ->result();
    }

    // Fetch all question by exam
    $questionInExam = $this->db->select('*')
      ->from('question_tbl')
      ->where('q_e_id', $exam_id)
      ->join('option_tbl', 'q_id=o_q_id', 'left')
      ->get()
      ->result();

    // Fetch question ids only
    $QueryQuestionIdInExam = $this->db->distinct()->select('q_id')
      ->from('question_tbl')
      ->where('q_e_id', $exam_id)
      ->join('option_tbl', 'q_id=o_q_id', 'left')
      ->get()
      ->result();

    // dd($QueryQuestionIdInExam, 0);

    // Prepare the question id array
    $resultQuestionIdsInExam = array();
    foreach ($QueryQuestionIdInExam as $questio_id) {
      $resultQuestionIdsInExam[] = $questio_id->q_id;
    }

    // dd($resultQuestionIdsInExam, 0);

    // Fetch the option for the filtered question only
    $QueryQuestionOptionsInExam = $this->db->select('*')
      ->from('option_tbl')
      ->where_in('o_q_id', $resultQuestionIdsInExam)
      ->get()
      ->result();

    // dd($QueryQuestionOptionsInExam, 0);

    // Parepare the final data.
    $data = array();
    if (!empty($enrolledStudent)) {
      foreach ($enrolledStudent as  $student) {
        $options_total_count = 0;
        if (!empty($questionInExam)) {
          foreach ($questionInExam as  $question) {
            // Question Count
            // $data[$student->se_u_id]['question_count'] = count($QueryQuestionIdInExam);
            // Sort Data By Student By Question
            $data[$student->se_u_id][$question->q_id] = array(
              'q_id' => $question->q_id,
              'q_e_id' => $question->q_e_id,
              'q_question' => $question->q_question,

            );
            // Sort Option By Student By Question
            $options_total_count += 1;
            foreach ($QueryQuestionOptionsInExam as $option) {
              if ($option->o_q_id == $question->q_id) {

                $data[$student->se_u_id][$question->q_id]['options'][$option->o_id] = [
                  'o_id' => $option->o_id,
                  'o_value' => $option->o_value,
                  'o_correct' => $option->o_correct
                ];
              }
            }


            // Sort By Student Chossen option
            $chosenOption = $this->db->select('r_o_id')->from('response_tbl')->where('r_q_id', $question->q_id)->where('r_u_id', $student->se_u_id)->get()->row();

            if ($chosenOption == null) {
              $chosenOption = null;
            } else {
              $chosenOption = $chosenOption->r_o_id;
            }
            if ($chosenOption != null) {
              //$chosenOption->r_o_id;
              $data[$student->se_u_id][$question->q_id]['chosen'] = $chosenOption;
              $data[$student->se_u_id][$question->q_id]['attempted'] = 1;
            } else {
              $data[$student->se_u_id][$question->q_id]['chosen'] = -9999;
              $data[$student->se_u_id][$question->q_id]['attempted'] = 0;
            }
            // Check if correct option is chosen by student.
            $check = 1;
            $data[$student->se_u_id][$question->q_id]['correct'] = 0;
            foreach ($data[$student->se_u_id][$question->q_id]['options'] as  $option) {
              if ($option['o_correct'] && $option['o_id'] == $data[$student->se_u_id][$question->q_id]['chosen']) {
                $data[$student->se_u_id][$question->q_id]['correct'] = 1;
              }
            }
          }
          $options_total_count += 1;
        }
        $data[$student->se_u_id]['options_total_count'] = $options_total_count;
      }
    }

    if (!empty($data)) {
      return $data;
    } else {
      return false;
    }
  }

  public function update($data = [])
  {
    return $this->db->where('q_id', $data['q_id'])
      ->update($this->table, $data);
  }

  public function delete($id = null)
  {
    $this->db->where('q_id', $id)
      ->delete($this->table);

    if ($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_option_by_question_id($q_id = null)
  {
    $this->db->where('o_q_id', $q_id)
      ->delete($this->table);

    if ($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }

  public function read_options_by_question_id_for_edit($q_id)
  {
    $result =  $this->db->select("*")
      ->from($this->table)
      ->where('o_q_id', $q_id)
      ->get()
      ->result();


    $option_count = 0;
    $list = array();
    foreach ($result as $key => $option) {
      $list['o_value'][] = $option->o_value;
      if ($option->o_correct) {
        $list['o_correct'][] = $option_count;
      }
      $option_count++;
    }
    return $list;
  }
}
