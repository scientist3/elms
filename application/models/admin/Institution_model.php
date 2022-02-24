<?php defined('BASEPATH') or exit('No direct script access allowed');

class Institution_model extends CI_Model
{

  private $table = "institution_tbl";

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
      ->row();
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
      ->order_by('inst_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->inst_id] = $row->pl_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_as_list_active_only()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      ->where('pl_status', 1)
      ->order_by('inst_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('select_property_type');
    foreach ($result as $row) {
      $list[$row->inst_id] = $row->pl_name; //." - ".$row->firstname;
    }
    return $list;
  }

  public function read_by_id_as_array($id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('inst_id', $id)
      ->get()
      ->row_array();
  }

  public function read_property_type_name()
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('pt_parent_id', !null)
      ->get()
      ->result_array();
  }
  public function update($data = [])
  {
    return $this->db->where('inst_id', $data['inst_id'])
      ->update($this->table, $data);
  }

  public function delete($inst_id = null)
  {
    $this->db->where('inst_id', $inst_id)
      ->delete($this->table);

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function read_by_id($inst_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('inst_id', $inst_id)
      ->get()
      ->row_array();
  }

  public function read_by_id_as_obj($inst_id = null)
  {
    return $this->db->select("*")
      ->from($this->table)
      ->where('inst_id', $inst_id)
      ->get()
      ->row();
  }
}
