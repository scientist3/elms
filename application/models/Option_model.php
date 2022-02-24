<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Option_model extends CI_Model
{

	private $table = "option_tbl";

	public function read()
	{
		return $this->db->select('*')
			->from($this->table)
			//->where('e_status', '1')
			->get()
			->result();

		// $list[''] = "Select User Role";//display('select_user_role');
		// if (!empty($result)) {
		// 	foreach ($result as $value) {
		// 		$list[$value->ur_id] = ($value->ur_name);
		// 	}
		// 	return $list;
		// } else {
		// 	return false;
		// }
	}



	public function create($data = [])
	{
		return $this->db->insert($this->table, $data);
	}


	public function create_batch($data = [])
	{
		return $this->db->insert_batch($this->table, $data);
	}

	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('q_id', $id)
			->get()
			->row();
	}

	public function read_options_by_q_id($q_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('o_q_id', $q_id)
			->get()
			->result();
	}

	public function read_by_exam($exam_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('q_e_id', $exam_id)
			->get()
			->result();
	}

	public function update($data = [])
	{
		return $this->db->where('q_id', $data['q_id'])
			->update($this->table, $data);
	}

	public function delete($id = null)
	{
		$this->db->where('q_id', $id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_option_by_question_id($q_id = null)
	{
		$this->db->where('o_q_id', $q_id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function read_options_by_question_id_for_edit($q_id)
	{
		$result =  $this->db->select("*")
			->from($this->table)
			->where('o_q_id', $q_id)
			->get()
			->result();


		$option_count = 0;
		$list = array();
		foreach ($result as $key => $option) {
			$list['o_value'][] = $option->o_value;
			if ($option->o_correct) {
				$list['o_correct'][] = $option_count;
			}
			$option_count++;
		}
		return $list;
	}
}
