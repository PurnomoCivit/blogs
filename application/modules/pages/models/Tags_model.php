<?php 

/**
* 
*/
class Tags_model extends CI_Model
{

	protected $_table_name = "tags";

	public function select($condition = null){
		$data = array();

		if(!empty($condition)){
			$data = $this->db->get_where($this->_table_name, $condition);
		}else{
			$data = $this->db->get($this->_table_name);
		}

		return $data->result_array();
	}

	public function save($data){
		$this->db->insert_batch($this->_table_name, $data);
		return $this->db->insert_id();
	}

	public function update($id, $data){
		$this->db->where('id', $id);
		$this->db->set($data);
		return $this->db->update($this->_table_name);
	}

	public function delete($id){
		$this->db->where('id', $id);
		return $this->db->delete($this->_table_name);
	}
	
}