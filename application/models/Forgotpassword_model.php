<?php

class Forgotpassword_model extends CI_Model {

	public function email_exists($email)
	{	
		$query = $this->db->get_where('users', ['email' => $email]);
		return $query->row();

	}


	public function verify_reset_password_code($email, $email_code)
	{
		$query = $this->db->get_where('users', ['email' => $email]);
		$old_password = $query->row()->password;
		$email_code = str_replace('~', '/', $email_code);
		if(password_verify($old_password, $email_code)) {
			return TRUE;
		}

		return FALSE;
	}



	public function update_password()
	{
		$email = $this->input->post('email');

		$enc_password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);

		$data = [
			'password' => $enc_password,			
			];
		$this->db->where('email', $email);
		return $this->db->update('users', $data);
	}





}