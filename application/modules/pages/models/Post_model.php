<?php 

/**
* 
*/
class Post_model extends CI_Model
{

	protected $_table_name = "post";

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
		$this->db->insert($this->_table_name, $data);
		return $this->db->insert_id();
	}

	public function update($id, $data){
		$this->db->where('id', $id);
		$this->db->set($data);
		return $this->db->update($this->_table_name);
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->_table_name);

		$this->db->where('id_post', $id);
		return $this->db->delete('tags');
	}
	
}