<?php defined('BASEPATH') or exit('No direct script access allowed');

class Designation_model extends CI_Model
{

  private $table = "designation_tbl";

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
      ->order_by('desg_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('Select Designation');
    foreach ($result as $row) {
      $list[$row->desg_id] = $row->desg_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_as_list_active_only()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      ->where('desg_status', 1)
      ->order_by('desg_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->desg_id] = $row->desg_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_by_id_as_array($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('desg_id', $id)
      ->get()
      ->row_array();
  }


  public function update($data = [])
  {
    return $this->db->where('desg_id', $data['desg_id'])
      ->update($this->table, $data);
  }

  public function delete($desg_id = null)
  {
    $this->db->where('desg_id', $desg_id)
      ->delete($this->table);

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function read_by_id($desg_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('desg_id', $desg_id)
      ->get()
      ->row_array();
  }

  public function read_by_id_as_obj($desg_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('desg_id', $desg_id)
      ->get()
      ->row();
  }
}
