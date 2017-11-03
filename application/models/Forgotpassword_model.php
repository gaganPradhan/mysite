<?php
class Forgotpassword_model extends CI_Model {

	function user_exists() {
		$query = $this->db->get_where('users', ['email'=> $this->input->post('email')]);
			return $query->row();
	}
	
	function send_reset_password_email($email, $username){
		$this->load->library('email');
		$email_code = password_hash($username, PASSWORD_BCRYPT);
		$config = [
			 'protocol' => 'smtp', 
			 'smtp_host' => 'ssl://smtp.googlemail.com', 
			 'smtp_port' => 465, 
			 'smtp_user' => 'namoshi.test@gmail.com', 
			 'smtp_pass' => '$password',
			 'mailtype' => 'html',
  			 'charset' => 'charset-utf-8',
  			 'wordwrap' => TRUE 
		   ]; 
		$this->load->library('email', $config); 
		$this->email->set_newline("\r\n");
	    $this->email->from('namoshi.test@gmail.com', 'Grafi');
		$this->email->to($email);
		$this->email->subject('Reset Password '); 
		$this->email->message('reset password');
	    if (!$this->email->send()) {
		    show_error($this->email->print_debugger()); 
		}else {
		   return TRUE;
		}
	}
	} 