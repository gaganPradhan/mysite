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

	public function get_request($id){		
		$query = $this->db->get_where('requests', ['id'=> $id]);
		return $query->row_object();	
	}

	public function get_requests_list($value){
		$this->db->order_by('request_date');
			$this->db->select('*, requests.id AS id');    
			$this->db->from('users');
			$this->db->join('requests', 'users.id = requests.user_id');
			$this->db->join('departments', 'users.dpt_id = departments.id');
			$this->db->where('status', $value);
			$query = $this->db->get();
			return $query->result_object();
	}

	/*Check if user has a pending request*/
	public function has_request(){
		if($this->session->has_userdata('username')){
			$query = $this->db->get_where('users', ['username' => $this->session->userdata('username')]);
			$id    = $query->row_object()->id;
			$query = $this->db->get_where('requests', ['status' => 'pending']);
			$datas = $query->result_object();
			foreach ($datas as $data) {
				if($id === $data->user_id){
					return $data;
				}	
			}	
		}
		return FALSE;	
	}

	public function update_request(){
		$data = [
			'status'        => $this->input->post('status'),
			'remarks'       => $this->input->post('remarks'),
			'updated_date'  => date('Y-m-d')
		];	
		if(strcmp($this->input->post('org_status'), $this->input->post('status')) !=0 ){
			$data['notification'] = TRUE;
		
		}else{
			$data['notification'] = FALSE;
		}
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('requests', $data);
		return TRUE;
	}

	/*check if the previous request was acknowledged*/
	public function has_notification(){
		if($this->session->has_userdata('username')){
			$query = $this->db->get_where('users', ['username' => $this->session->userdata('username')]);
			$id    = $query->row_object()->id;
			$query = $this->db->get_where('requests', ['notification' => FALSE]);
			$datas = $query->result_object();
			foreach ($datas as $data) {
				if($id === $data->user_id){					
				return FALSE;
				}	
			}	
		}		
		return TRUE;	
	}
	
}