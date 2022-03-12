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

  public function read_with_join($condition = [], $returnAsArray = false, $statusType = [])
  {
    $this->db->select(
      "leaves_tbl.l_id,
      user_tbl.u_name as faculty_name,
      user_tbl.u_picture,
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
    $this->db->join('user_tbl',         'user_tbl.u_id            = leaves_tbl.l_user_id',        'left');
    $this->db->join('designation_tbl',  'designation_tbl.desg_id  = user_tbl.u_desg_id',          'left');
    $this->db->join('department_tbl',   'department_tbl.dept_id   = user_tbl.u_dept_id',          'left');
    $this->db->join('leave_type_tbl',   'leave_type_tbl.lt_id     = leaves_tbl.l_leave_type_id',  'left');
    $this->db->join('leave_status_tbl', 'leave_status_tbl.ls_id   = leaves_tbl.l_status',         'left');

    if (valArr($condition)) {
      $this->db->where($condition);
    }
    if (valArr($statusType)) {
      $this->db->where_in('l_status', $statusType);
    }
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

  public function get_toal_leaves_by_status_by_user_id($u_id)
  {
    $result = $this->db->select(
      'l_status,
      l_user_id,
      SUM( 
        CASE
          WHEN DATEDIFF( l_to_date,l_from_date) = 0 THEN 1
          ELSE DATEDIFF( l_to_date,l_from_date) + 1
        END) as total_days'
    )
      ->from('leaves_tbl')
      ->where(array('l_user_id' => $u_id))
      ->group_by('l_status')
      ->order_by('l_status ASC')
      ->get()->result();

    if (valArr($result)) {
      $result = rekeyArray('l_status', $result);
      $total = 0;
      foreach ($result as $leave_type_id => $objLeaveStatus) {
        $total += $objLeaveStatus->total_days;
      }
      $result['total_leaves'] = $total;
    } else {
      $result[1] = (object) ['total_days' => 0];
      $result[2] = (object) ['total_days' => 0];
      $result[3] = (object) ['total_days' => 0];
      $result['total_leaves'] = 0;
    }
    return $result;
  }

  public function get_total_leaves_by_leave_type_by_user_id($u_id)
  {
    //
    $result = $this->db->select(' ls_name, lt_name, `l_user_id`,`l_leave_type_id`,`l_status`,SUM(case when DATEDIFF( l_to_date, l_from_date) = 0 then 1 else DATEDIFF( l_to_date, l_from_date) + 1 end) as total_days')
      ->from('`leaves_tbl`')
      ->where('l_user_id', $u_id)
      ->group_by(array('`l_user_id`', '`l_leave_type_id`', '`l_status`'))
      ->order_by('`l_user_id` ASC, `l_leave_type_id` ASC, `l_status` ASC')
      ->join('leave_status_tbl', 'ls_id = l_status', 'left')
      ->join('leave_type_tbl', 'lt_id = l_leave_type_id', 'left')
      ->get()->result();
    $arrleave_type = array_keys(rekeyObject('lt_name', $result));
    $arrleave_status = array_keys(rekeyObject('ls_name', $result));
    // dd($arrleave_type); // dd($arrleave_status); // dd(sort($arrleave_status)); 
    // dd($result);
    $arrLeaveTypeByLeaveStatusByTotalDays = [];
    foreach ($arrleave_type as $leave_type) {
      foreach ($result as $key => $leave) {
        if ($leave->lt_name == $leave_type)
          $arrLeaveTypeByLeaveStatusByTotalDays[$leave_type][$leave->ls_name]['total_days'] = $leave->total_days;
      }
    }
    // dd($arrLeaveTypeByLeaveStatusByTotalDays);

    $arrLeaveTypeByAllLeaveStatusByTotalDays = [];
    foreach ($arrLeaveTypeByLeaveStatusByTotalDays as $l_type => $arrLeaveStatus) {
      foreach ($arrleave_status as $l_status) {
        $arrLeaveTypeByAllLeaveStatusByTotalDays[$l_type][$l_status]['total_days'] = isset($arrLeaveStatus[$l_status]) ? $arrLeaveStatus[$l_status]['total_days'] : 0;
      }
    }
    // dd($arrLeaveTypeByAllLeaveStatusByTotalDays);
    // die();
    return $arrLeaveTypeByAllLeaveStatusByTotalDays;
  }

  // public function get_total_leaves_by_leave_type_by_user_id($u_id)
  // {
  //   //
  //   $result = $this->db->select('`l_user_id`,`l_leave_type_id`,`l_status`,SUM(case when DATEDIFF( l_to_date, l_from_date) = 0 then 1 else DATEDIFF( l_to_date, l_from_date) + 1 end) as total_days')
  //     ->from('`leaves_tbl`')
  //     ->where('l_user_id', $u_id)
  //     ->group_by(array('`l_user_id`', '`l_leave_type_id`', '`l_status`'))
  //     ->order_by('`l_user_id` ASC, `l_leave_type_id` ASC, `l_status` ASC')
  //     ->get()->result();
  //   $arrleave_type = array_keys(rekeyObject('l_leave_type_id', $result));
  //   $arrleave_status = array_keys(rekeyObject('l_status', $result));
  //   // dd($arrleave_type);
  //   // dd($arrleave_status);
  //   // dd(sort($arrleave_status));
  //   // dd($result);
  //   $arrLeaveTypeByLeaveStatusByTotalDays = [];
  //   foreach ($arrleave_type as $leave_type) {
  //     foreach ($result as $key => $leave) {
  //       if ($leave->l_leave_type_id == $leave_type)
  //         $arrLeaveTypeByLeaveStatusByTotalDays[$leave_type][$leave->l_status]['total_days'] = $leave->total_days;
  //     }
  //   }
  //   // dd($arrLeaveTypeByLeaveStatusByTotalDays);

  //   $arrLeaveTypeByAllLeaveStatusByTotalDays = [];
  //   foreach ($arrLeaveTypeByLeaveStatusByTotalDays as $l_type => $arrLeaveStatus) {
  //     foreach ($arrleave_status as $l_status) {
  //       $arrLeaveTypeByAllLeaveStatusByTotalDays[$l_type][$l_status]['total_days'] = isset($arrLeaveStatus[$l_status]) ? $arrLeaveStatus[$l_status]['total_days'] : 0;
  //     }
  //   }
  //   dd($arrLeaveTypeByAllLeaveStatusByTotalDays);

  //   foreach ($arrleave_status as $leave_status) {
  //     // $list[$arrleave_type][$leave_status] = $result
  //   }
  //   die();
  //   return rekeyObject('lt_name', $result);
  // }

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

  public function get_todays_leaves_by_status_by_day($l_status = [1], $day = ['full_day', 'half_day'])
  {
    return $this->db->select('count(lt.l_id) as total_leaves')
      ->from($this->table . ' lt')
      ->where_in('lt.l_is_half_day', $day)
      ->where_in('lt.l_from_date', [date('Y-m-d')])
      ->where_in('lt.l_status', $l_status)
      ->get()->row()->total_leaves;
  }

  public function get_current_month_leaves_by_leave_status()
  {
    $startDayOfMonth = date('Y-m-01');
    $endDayOfMonth = date('Y-m-t');
    $result = $this->db->select('l_status,count(l_id) as total')
      ->from('leaves_tbl')
      ->where('l_from_date >=', $startDayOfMonth)
      ->where('l_from_date <=', $endDayOfMonth)
      ->group_by('l_status')
      ->get()->result();

    $result = rekeyObject('l_status', $result);
    $leave_count_by_status['total'] = 0;

    // FIXME: Make it dynamic with all types form leave_status_tbl 
    for ($leave_status = 1; $leave_status <= 3; $leave_status++) {
      $leave_count_by_status[$leave_status] = $result[$leave_status]->total ?? 0;
      $leave_count_by_status['total'] += $result[$leave_status]->total ?? 0;
    }

    return $leave_count_by_status;
  }

  public function get_current_year_leaves_by_leave_status()
  {
    $startDayOfYear = date('Y-01-01');
    $endDayOfYear = date('Y-12-t');

    $result = $this->db->select('l_status,count(l_id) as total')
      ->from('leaves_tbl')
      ->where('l_from_date >=', $startDayOfYear)
      ->where('l_from_date <=', $endDayOfYear)
      ->group_by('l_status')
      ->get()->result();

    $result = rekeyObject('l_status', $result);
    $leave_count_by_status['total'] = 0;

    // FIXME: Make it dynamic with all types form leave_status_tbl 
    for ($leave_status = 1; $leave_status <= 3; $leave_status++) {
      $leave_count_by_status[$leave_status] = $result[$leave_status]->total ?? 0;
      $leave_count_by_status['total'] += $result[$leave_status]->total ?? 0;
    }

    return $leave_count_by_status;
  }
}
