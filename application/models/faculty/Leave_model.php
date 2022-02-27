<?php defined('BASEPATH') or exit('No direct script access allowed');

class Leave_model extends CI_Model
{

  private $table = "leaves_tbl";

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

  public function read_with_join($returnAsArray = false)
  {
    $this->db->select(
      "leaves_tbl.l_id,
      user_tbl.u_name as faculty_name,
      user_tbl.u_id,
      designation_tbl.desg_name  as faculty_desg,
      department_tbl.dept_name as faculty_dept,
      leave_type_tbl.lt_name as leave_type,
      leaves_tbl.l_applied_date,
      leaves_tbl.l_to_date,
      leaves_tbl.l_from_date,
      leaves_tbl.l_is_half_day,
      leaves_tbl.l_first_or_second_half,
      leaves_tbl.l_reason,
      leaves_tbl.l_document,
      leaves_tbl.l_status,
      leave_status_tbl.ls_name,
      leaves_tbl.l_comments
      "
    );

    $this->db->from($this->table);
    $this->db->join('user_tbl',         'user_tbl.u_id            = leaves_tbl.l_user_id',      'left');
    $this->db->join('designation_tbl',  'designation_tbl.desg_id  = user_tbl.u_desg_id',    'left');
    $this->db->join('department_tbl',   'department_tbl.dept_id   = user_tbl.u_dept_id',    'left');
    $this->db->join('leave_type_tbl',   'leave_type_tbl.lt_id     = leaves_tbl.l_leave_type_id',  'left');
    $this->db->join('leave_status_tbl', 'leave_status_tbl.ls_id   = leaves_tbl.l_status',       'left');

    $this->db->order_by('leaves_tbl.l_applied_date', 'DESC');

    // $this->db->limit($limit, $start);
    // echo $this->db->get_compiled_select();
    if ($returnAsArray == true) {
      return $this->db->get()->result_array();
    } else {
      return $this->db->get()->result();
    }
  }

  public function read_with_join_by_id($l_id = null, $returnAsArray = false)
  {
    $this->db->select(
      "leaves_tbl.l_id,
      user_tbl.u_name as faculty_name,
      user_tbl.u_id,
      designation_tbl.desg_name  as faculty_desg,
      department_tbl.dept_name as faculty_dept,
      leave_type_tbl.lt_name as leave_type,
      leaves_tbl.l_applied_date,
      leaves_tbl.l_to_date,
      leaves_tbl.l_from_date,
      leaves_tbl.l_is_half_day,
      leaves_tbl.l_first_or_second_half,
      leaves_tbl.l_reason,
      leaves_tbl.l_document,
      leaves_tbl.l_status,
      leave_status_tbl.ls_name,
      leaves_tbl.l_comments
      "
    );

    $this->db->from($this->table);
    $this->db->where('l_id', $l_id);
    $this->db->join('user_tbl',         'user_tbl.u_id            = leaves_tbl.l_user_id',      'left');
    $this->db->join('designation_tbl',  'designation_tbl.desg_id  = user_tbl.u_desg_id',    'left');
    $this->db->join('department_tbl',   'department_tbl.dept_id   = user_tbl.u_dept_id',    'left');
    $this->db->join('leave_type_tbl',   'leave_type_tbl.lt_id     = leaves_tbl.l_leave_type_id',  'left');
    $this->db->join('leave_status_tbl', 'leave_status_tbl.ls_id   = leaves_tbl.l_status',       'left');

    $this->db->order_by('leaves_tbl.l_applied_date', 'DESC');

    // $this->db->limit($limit, $start);
    // echo $this->db->get_compiled_select();
    if ($returnAsArray == true) {
      return $this->db->get()->row_array();
    } else {
      return $this->db->get()->row();
    }
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
      ->order_by('l_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('Select leave');
    foreach ($result as $row) {
      $list[$row->l_id] = $row->l_id; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_as_list_active_only()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      ->where('dept_status', 1)
      ->order_by('l_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->l_id] = $row->dept_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_by_id_as_array($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('l_id', $id)
      ->get()
      ->row_array();
  }

  // Read Pending time off requests

  public function read_pending_requests($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('l_status', 1)
      ->get()
      ->result();
  }

  public function update($data = [])
  {
    return $this->db->where('l_id', $data['l_id'])
      ->update($this->table, $data);
  }

  public function delete($l_id = null)
  {
    $this->db->where('l_id', $l_id)
      ->delete($this->table);

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function read_by_id($l_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('l_id', $l_id)
      ->get()
      ->row_array();
  }

  public function read_by_id_as_obj($l_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('l_id', $l_id)
      ->get()
      ->row();
  }
}
