<?php defined('BASEPATH') or exit('No direct script access allowed');

class Designation_model extends CI_Model
{

  private $table = "designation_tbl";


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
}
