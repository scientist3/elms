<?php defined('BASEPATH') or exit('No direct script access allowed');

class Faculty_model extends CI_Model
{

  private $table = "user_tbl";

  public function create($data = [])
  {
    return $this->db->insert($this->table, $data);
  }

  public function read($user_role = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('u_user_role', $user_role)
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
      ->order_by('u_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('Select Faculty');
    foreach ($result as $row) {
      $list[$row->u_id] = $row->u_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_as_list_active_only()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      ->where('u_status', 1)
      ->order_by('u_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->u_id] = $row->u_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_by_id_as_array($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('u_id', $id)
      ->get()
      ->row_array();
  }


  public function update($data = [])
  {
    return $this->db->where('u_id', $data['u_id'])
      ->update($this->table, $data);
  }

  public function delete($u_id = null)
  {
    $this->db->where('u_id', $u_id)
      ->delete($this->table);

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function read_by_id($u_id = null)
  {
    return $this->db->select($this->table . ".*, designation_tbl.desg_name, department_tbl.dept_name")
      ->from($this->table)
      ->where('u_id', $u_id)
      ->join('designation_tbl', 'desg_id = ' . $this->table . '.u_desg_id', 'left')
      ->join('department_tbl', 'dept_id = ' . $this->table . '.u_dept_id', 'left')
      ->get()
      ->row_array();
  }

  public function read_by_id_as_obj($u_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('u_id', $u_id)
      ->get()
      ->row();
  }

  public function get_faculty_designation($user_id)
  {
    return $this->db->select("u_desg_id")
      ->from($this->table)
      ->where('u_id', $user_id)
      ->get()
      ->row()->u_desg_id;
  }
}
