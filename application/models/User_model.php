<?php

class User_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->load->library('encryption');
	}

	/*Create User Account*/
	public function set_user($image){
		$slug = url_title($this->input->post('username'), 'dash', TRUE);	
		$salt = 'grafi';
		$data = [
			'username' => $this->input->post('username'),
			'password' => hash('sha256', $this->input->post('password').$salt),
			'name'     => $this->input->post('name'),
			'email'    => $this->input->post('email'),
			'slug'     => $slug,
			'image'    => $image,
			'salt'     => $salt,
			'dpt_id'   => $this->input->post('department'),
			'groups'   => '1'
		];

 		if($this->input->post('admin') == TRUE) {
 			$data['groups'] = '2';
 		}
		return $this->db->insert('users', $data);
	}

	/*Get User Details*/
	public function get_users($slug = FALSE){
		if($slug === FALSE){
			$this->db->order_by('username');
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

	/*Get User Department*/
	public function get_departments($id = NULL){
		if($id == NULL){
			$query = $this->db->get('departments');	
			return $query->result_object();	
		}
		$query = $this->db->get_where('departments', ['id' => $id]);
		return $query->row_object();
		
	}

	/*Check Login Validation*/
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

	/*Check if user is logged in and gives user slug*/
	public function logged_in(){
		if($this->session->has_userdata('username')){
			$query = $this->db->get_where('users', ['username'=> $this->session->userdata('username')]);		
			return $query->row_object()->slug;
		}
	}

	/*Update User Profile*/
	public function update_user($image){
		$slug = url_title($this->input->post('username'), 'dash', TRUE);	
		$salt = 'grafi';
		$data = [
			'username' => $this->input->post('username'),
			'name'     => $this->input->post('name'),
			'email'    => $this->input->post('email'),
			'slug'     => $slug,
			'image'    => $image,
			'dpt_id'   => $this->input->post('department'),
			
 		];
		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('users', $data);
	}

	public function delete_user($id){
		$user = self::get_users($id);
		if(is_numeric($id)){
			if(strcasecmp($user->image, "noimage.png") != 0){
				unlink('assets/images/'.$user->image);
			}	
			return $query = $this->db->delete('users', ['id' => $id]);
		}
		if(strcasecmp($user->image, "noimage.png") != 0){
			unlink('assets/images/'.$user->image);
		}	
		return $query = $this->db->delete('users', ['slug'=>$id]);
	}

	/*Check if current user admin*/
	public function has_permission($key, $username){
		$this->db->select('groups');
		$this->db->from('users');
		$this->db->where('username', $username);
		$query=$this->db->get();
		$id = $query->row()->groups;
		$query = $this->db->get_where('groups',['id' => $id]);		
		if($query->num_rows()>0) {
			$permissions = json_decode($query->row_object()->permissions, true);
			if($permissions[$key] == true) {
				return true;
			}
		}
		return false;
	}
	
	public function password_change(){
		$salt = 'grafi';
		$data = [
			'password' => hash('sha256', $this->input->post('password').$salt)
		];		
		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('users', $data);
	}
}	