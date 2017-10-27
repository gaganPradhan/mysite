<?php

class User_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->load->library('encryption');
	}
	public function set_user(){
		$slug = url_title($this->input->post('username'), 'dash', TRUE);	
		$salt = 'grafi';
		$data = [
			'username' => $this->input->post('username'),
			'password' => hash('sha256', $this->input->post('password').$salt),
			'name'     => $this->input->post('name'),
			'email'    => $this->input->post('email'),
			'slug'     => $slug,
			'image'    => $this->upload->data('file_name'),
			'salt'     => $salt
		];		
		return $this->db->insert('users', $data);
	}

	public function get_users($slug = FALSE){
		if($slug === FALSE){
			$query = $this->db->get('users');
			return $query->result_object();
		}
		if(is_numeric($slug)){
			$query = $this->db->get_where('users', ['id'=> $slug]);
			return $query->row_object();
		}else{
			$query = $this->db->get_where('users', ['slug'=> $slug]);
			return $query->row_object();
		}

	}	

	public function login_valid(){		
		$salt = 'grafi';
		$password = $this->input->post('password').$salt;
		$params = [
					'condition' => [
									'username' => $this->input->post('username'),
									'password' => hash('sha256', $password)
								  ]
					];		
		$this->db->select('*');
		$this->db->from('users');
		if(array_key_exists('condition', $params)){
			foreach ($params['condition'] as $key => $value) {			
				$this->db->where($key, $value);			
			}
		}	
		$query = $this->db->get();	
		$result = ($query->num_rows() > 0)? $query->row()->slug : FALSE;
		return $result;
	}

	public function logged_in(){
		if($this->session->has_userdata('username')){
			$query = $this->db->get_where('users', ['username'=> $this->session->userdata('username')]);		
			return $query->row_object()->slug;
		}
	}
}	