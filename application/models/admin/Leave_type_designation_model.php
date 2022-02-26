<?php defined('BASEPATH') or exit('No direct script access allowed');

class Leave_type_designation_model extends CI_Model
{

  private $table = "leave_type_designation_mapping_tbl";

  public function create($data = [])
  {
    return $this->db->insert($this->table, $data);
  }

  public function read_leave_type_by_designation($designation_id)
  {

    $this->db->select('ltdm_lt_id as lt_id , leave_type_tbl.lt_name')
      ->from($this->table)
      ->where(array('ltdm_desg_id' => $designation_id));

    $this->db->join(
      'leave_type_tbl',
      'leave_type_tbl.lt_id = leave_type_designation_mapping_tbl.ltdm_lt_id',
      'left'
    );

    $this->db->order_by('ltdm_id', 'asc');

    // echo $this->db->get_compiled_select();
    $result = $this->db->get()->result();
    // $list[''] = ('Select leave');
    foreach ($result as $row) {
      $list[$row->lt_id] = $row->lt_name; //." - ".$row->firstname;
    }
    return $list ?? [];
  }
}
