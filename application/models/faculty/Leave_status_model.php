<?php defined('BASEPATH') or exit('No direct script access allowed');

class Leave_status_model extends CI_Model
{

  private $table = "leave_status_tbl";

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
      ->order_by('ls_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('Select leave_status');
    foreach ($result as $row) {
      $list[$row->ls_id] = $row->ls_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_as_list_active_only()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      ->where('desg_status', 1)
      ->order_by('ls_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->ls_id] = $row->ls_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_by_id_as_array($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('ls_id', $id)
      ->get()
      ->row_array();
  }


  public function update($data = [])
  {
    return $this->db->where('ls_id', $data['ls_id'])
      ->update($this->table, $data);
  }

  public function delete($ls_id = null)
  {
    $this->db->where('ls_id', $ls_id)
      ->delete($this->table);

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function read_by_id($ls_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('ls_id', $ls_id)
      ->get()
      ->row_array();
  }

  public function read_by_id_as_obj($ls_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('ls_id', $ls_id)
      ->get()
      ->row();
  }
}
