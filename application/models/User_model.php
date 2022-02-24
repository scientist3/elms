<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

	private $user_role_tbl = "user_role_tbl";

	public function get_user_role()
	{
		$result = $this->db->select('ur_id,ur_name')
			->from($this->user_role_tbl)
			->where('ur_status', '1')
			->get()
			->result();

		$list[''] = "Select User Role"; //display('select_user_role');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->ur_id] = ($value->ur_name);
			}
			return $list;
		} else {
			return false;
		}
	}

	public function get_enrolled_student_list($exam_id = null)
	{
		$enrolledStudent = $this->db->select('se_u_id,u_name')
			// ->from('user_tbl')
			->from('student_exam_tbl')
			->where('se_e_id', $exam_id)
			->join('user_tbl', 'se_u_id=u_id', 'left')
			->where('u_user_role', 2)
			->get()
			->result();

		// dd($enrolledStudent);
		$list[''] = "All Students"; //display('select_user_role');
		if (!empty($enrolledStudent)) {
			foreach ($enrolledStudent as $value) {
				$list[$value->se_u_id] = ($value->u_name);
			}
			return $list;
		} else {
			return false;
		}
	}
}
