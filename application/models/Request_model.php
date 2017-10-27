<?php
class Request_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function set_request(){
		$query = $this->db->get_where('users', ['username' => $this->session->userdata('username')]);
		$id = $query->row_object()->id;
		$data = [
			'user_id'        => $id,			
			'inventory_name' => $this->input->post('name'),			
			'detail'         => $this->input->post('detail'),
			'request_date'   => date('Y-m-d')
		];		
		return $this->db->insert('requests', $data);
	}

	public function get_requests($id = FALSE){
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

	public function has_request(){
		if($this->session->has_userdata('username')){
			$query = $this->db->get_where('users', ['username' => $this->session->userdata('username')]);
			$id    = $query->row_object()->id;
			$query = $this->db->get_where('requests', ['status' => 'pending']);
			$datas = $query->result_object();
			foreach ($datas as $data) {
				if($id === $data->user_id){
					return True;
				}	
			}	
		}
		return FALSE;	
	}
}