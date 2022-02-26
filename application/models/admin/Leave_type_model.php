<?php defined('BASEPATH') or exit('No direct script access allowed');

class leave_type_model extends CI_Model
{

  private $table = "leave_type_tbl";

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
      ->order_by('lt_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('Select leave_status');
    foreach ($result as $row) {
      $list[$row->lt_id] = $row->lt_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_as_list_active_only()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      ->where('desg_status', 1)
      ->order_by('lt_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->lt_id] = $row->lt_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_by_id_as_array($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('lt_id', $id)
      ->get()
      ->row_array();
  }


  public function update($data = [])
  {
    return $this->db->where('lt_id', $data['lt_id'])
      ->update($this->table, $data);
  }

  public function delete($lt_id = null)
  {
    $this->db->where('lt_id', $lt_id)
      ->delete($this->table);

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function read_by_id($lt_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('lt_id', $lt_id)
      ->get()
      ->row_array();
  }

  public function read_by_id_as_obj($lt_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('lt_id', $lt_id)
      ->get()
      ->row();
  }
}
