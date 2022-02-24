<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question_model extends CI_Model
{

	private $table = "question_tbl";

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

	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('q_id', $id)
			->get()
			->row();
	}

	public function read_by_exam($exam_id = null)
	{
		$result = $this->db->select("*")
			->from($this->table)
			->where('q_e_id', $exam_id)
			->where('q_status', 1)
			->get()
			->result();

		if (!$result) {
			return false;
		} else {
			//$list[] = '';
			foreach ($result as $question) {
				$list[$question->q_id]['question'] = $question->q_question;
				$list[$question->q_id]['options'] = $this->option_model->read_options_by_q_id($question->q_id);
			}
			return $list;
		}
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
}
