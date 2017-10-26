<?php
class Request_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getRequests($id = FALSE){
		if($id === FALSE){
			$this->db->select('*, requests.id AS id');    
			$this->db->from('users');
			$this->db->join('requests', 'users.id = requests.user_id');
			$this->db->join('departments', 'users.dpt_id = departments.id');
			$query = $this->db->get();
			return $query->result_object();
		}
		$query = $this->db->get_where('requests', ['id'=> $id]);
		return $query->row_object();	
	}
}