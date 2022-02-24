<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exam_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
	}
	private $table = "exam_tbl";

	public function read_by_user($user_id = null)
	{
		return $this->db->select('*')
			->from($this->table)
			->where('e_created_by', $user_id)
			->get()
			->result();
	}

	public function read()
	{
		return $this->db->select('*')
			->from($this->table)
			->get()
			->result();
	}

	public function read_todays_exam($std_id)
	{
		return $this->db->select('*')
			->from($this->table)
			->join('student_exam_tbl', 'se_e_id=e_id', 'left')
			->where('se_approved', 1)
			->where('date(e_exam_start)', date('Y-m-d'))
			->where('se_attempted', 0)
			->where('se_u_id', $std_id)
			->get()->result();
		// ->get_compiled_select();
		// ->result();
	}

	public function read_applied_exams($std_id)
	{
		return $this->db->select('*')
			->from($this->table)
			->join('student_exam_tbl', 'se_e_id=e_id', 'left')
			->where('se_approved', 0)
			->where('se_attempted', 0)
			->where('se_u_id', $std_id)
			->get()
			->result();
	}

	public function read_approved_exams($std_id)
	{
		return $this->db->select('*')
			->from($this->table)
			->join('student_exam_tbl', 'se_e_id=e_id', 'left')
			->where('se_approved', 1)
			->where('se_attempted', 0)
			->where('se_u_id', $std_id)
			->get()
			->result();
	}
	public function read_upcomming_exams($returnsql = false)
	{
		date_default_timezone_set("Asia/Kolkata");

		$this->db->select('*')
			->from($this->table)
			//->join('student_exam_tbl', 'se_e_id=e_id', 'left')
			->where('e_reg_end >= ', date('Y-m-d H:m:s'))
			->order_by('e_reg_end', 'desc');

		if ($returnsql == true) {
			return $this->db->get_compiled_select();
		} else {
			return $this->db->get()->result();
		}
		//->where('se_approved =', null)
	}

	public function read_past_exams()
	{
		return $this->db->select('*')
			->from($this->table)
			->where('e_exam_start < ', date('Y-m-d H:m:s'))
			->get()
			->result();
	}


	public function read_as_list()
	{
		$result = $this->db->select('e_id,e_name')
			->from($this->table)
			->where('e_status', '1')
			->get()
			->result();

		$list[''] = "Select the exam"; //display('select_user_role');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->e_id] = ($value->e_name);
			}
			return $list;
		} else {
			return false;
		}
	}

	public function read_as_list_by_user($user_id = null)
	{
		$result = $this->db->select('e_id,e_name')
			->from($this->table)
			->where('e_created_by', $user_id)
			->get()
			->result();

		$list[''] = "Select the exam"; //display('select_user_role');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->e_id] = ($value->e_name);
			}
			return $list;
		} else {
			return false;
		}
	}
	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}

	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('e_id', $id)
			->get()
			->row();
	}

	public function update($data = [])
	{
		return $this->db->where('e_id', $data['e_id'])
			->update($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('e_id', $id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}
}
