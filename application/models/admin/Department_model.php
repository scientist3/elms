<?php defined('BASEPATH') or exit('No direct script access allowed');

class Department_model extends CI_Model
{

  private $table = "department_tbl";

  public function create($data = [])
  {
    return $this->db->insert($this->table, $data);
  }

  public function read()
  {
    return $this->db->select("*")
      ->from($this->table)
      //->order_by('firstname', 'asc')
      ->get()
      ->result();
  }

  public function read_as_array()
  {
    return $this->db->select("*")
      ->from($this->table)
      //->order_by('firstname', 'asc')
      ->get()
      ->result_array();
  }

  public function read_as_list()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      //->where('page_name',$page_name)
      ->order_by('dept_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->dept_id] = $row->dept_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_as_list_active_only()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      ->where('dept_status', 1)
      ->order_by('dept_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->dept_id] = $row->dept_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_by_id_as_array($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('dept_id', $id)
      ->get()
      ->row_array();
  }


  public function update($data = [])
  {
    return $this->db->where('dept_id', $data['dept_id'])
      ->update($this->table, $data);
  }

  public function delete($dept_id = null)
  {
    $this->db->where('pl_id', $dept_id)
      ->delete($this->table);

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function read_by_id($pl_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('pl_id', $pl_id)
      ->get()
      ->row_array();
  }

  public function read_by_id_as_obj($pl_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('pl_id', $pl_id)
      ->get()
      ->row();
  }
}
