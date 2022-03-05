<?php defined('BASEPATH') or exit('No direct script access allowed');

class Department_model extends CI_Model
{

  private $table = "department_tbl";

  public function create($data = [])
  {
    return $this->db->insert($this->table, $data);
  }

  public function read_as_list()
  {
    $result = $this->db->select("*")
      ->from($this->table)
      //->where('page_name',$page_name)
      ->order_by('dept_id', 'asc')
      ->get()
      ->result();
    $list[''] = ('Select Department');
    foreach ($result as $row) {
      $list[$row->dept_id] = $row->dept_name; //." - ".$row->firstname;
    }
    return $list;
  }
}
