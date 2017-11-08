<?php
class MY_Controller extends CI_Controller {
	/*Check if user is logged in and gives user slug*/
	public function logged_in(){
		if($this->session->has_userdata('username')){
			$query = $this->db->get_where('users', ['username'=> $this->session->userdata('username')]);		
			return $query->row_object()->slug;
		}
	}

	public function not_loggedin_for_pw_recovery(){
		if($this->session->userdata('username')){
			$this->session->set_flashdata('login', 'You Are Already Logged in');
			redirect('users/account');
		}
		return TRUE;
	}
}