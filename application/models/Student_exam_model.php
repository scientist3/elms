<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_exam_model extends CI_Model
{

  private $table = "student_exam_tbl";

  public function create($data = [])
  {
    return $this->db->insert($this->table, $data);
  }

  public function read_by_exam_by_student($std_id)
  {
    $result =  $this->db->select('*')
      ->from($this->table)
      ->where('se_u_id', $std_id)
      ->get()
      ->result();
    $list = [];
    if (!empty($result)) {
      foreach ($result as $std_exam) {
        $list[$std_exam->se_e_id]['approved'] = $std_exam->se_approved;
        $list[$std_exam->se_e_id]['attempted'] = $std_exam->se_attempted;
      }
    }
    return $list;
  }

  public function read_by_exam_by_all_students()
  {
    $result =  $this->db->select('*')
      ->from($this->table)
      ->get()
      ->result();

    $list = [];

    if (!empty($result)) {
      foreach ($result as $std_exam) {
        $list[$std_exam->se_e_id][$std_exam->se_u_id]['applied'] = 1;
        $list[$std_exam->se_e_id][$std_exam->se_u_id]['approved'] = $std_exam->se_approved;
        $list[$std_exam->se_e_id][$std_exam->se_u_id]['attempted'] = $std_exam->se_attempted;
      }
    }

    return $list;
  }

  public function read_by_id($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('q_id', $id)
      ->get()
      ->row();
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

  public function total_exams_applied_by_student($std_id)
  {
    return count($this->read_by_exam_by_student($std_id));
  }

  public function total_exams_attempted_by_student($std_id)
  {
    $arrmixAllExamsByStudent = $this->read_by_exam_by_student($std_id);

    $count = 0;

    if (!empty($arrmixAllExamsByStudent)) {
      foreach ($arrmixAllExamsByStudent as $exam) {
        if ($exam['attempted'] == 1) {
          $count++;
        }
      }
    }

    return $count ?? 0;
  }
}
