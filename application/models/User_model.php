<?php

class User_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->load->library('encryption');
	}
	public function set_user(){
		$slug = url_title($this->input->post('username'), 'dash', TRUE);	

		$data = [
			'username' => $this->input->post('username'),
			'password' => hash('sha256', $this->input->post('password').'grafi'),
			'email' => $this->input->post('email'),
			'slug' => $slug,
			'image' => $this->upload->data('file_name')
		];

		return $this->db->insert('users', $data);
	}

	public function get_users($id = FALSE){
		if($id === FALSE){
			$query = $this->db->get('users');
			return $query->result_object();
		}

		$query = $this->db->get_where('users', ['id'=> $id]);
		return $query->row_object();
	}	

	public function getUser($params = []){
		$this->db->select('*');
		$this->db->from('users');
		if(array_key_exists('condition', $params)){
			foreach ($params['condition'] as $key => $value) {			
			$this->db->where($key, $value);			
			}
		}	
		$query = $this->db->get();
		$result = ($query->num_rows() > 0)? TRUE : FALSE;
		return $result;
	}
}	