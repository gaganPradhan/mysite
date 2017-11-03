<?php

class Newsletter_model extends CI_Model {
	public function show_news($id = Null){
		if($id == NULL){
			$this->db->order_by('date');
			$this->db->select('*, news.id AS id');    
			$this->db->from('users');
			$this->db->join('news', 'users.id = news.user_id');
			$this->db->join('departments', 'users.dpt_id = departments.id');
			$query = $this->db->get();
			return $query->result_object();	
		}
		else{
			$data= $this->db->get_where('news', ['id' => $id]);
			return $data->row();
		}
		
	}

	public function add_news($image){
		$user_data = $this->db->get_where('users', ['username'=> $this->input->post('username')]);
		$user_id = $user_data->row()->id;
		$data = [
			'title' 	=> $this->input->post('title'),
			'body' 		=> $this->input->post('body'),
			'date' 		=> $this->input->post('date'),
			'user_id'   => $user_id,
			'image'     => $image
		];
		$this->db->insert('news', $data);
	}

	public function get_news($id) {
		$query = $this->db->get_where('news', ['id'=> $id]);
		return $query->row_object();	
	}

	public function delete_news($id){
		$news = self::show_news($id);
		if(is_numeric($id)){
			if(strcasecmp($news->image, "noimage.png") != 0){
				unlink('assets/images/'.$news->image);
			}	
			return $query = $this->db->delete('news', ['id' => $id]);
		}
		if(strcasecmp($news->image, "noimage.png") != 0){
			unlink('assets/images/'.$news->image);
		}	
		return $query = $this->db->delete('news', ['slug'=>$id]);
	}

}