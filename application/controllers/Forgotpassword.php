<?php 

class ForgotPassword extends MY_Controller {

	public function email_exists($email)
	{
		$result = $this->forgotpassword_model->email_exists($email);
		if(!$result) {
			$this->form_validation->set_message('email_exists', 'This email is not registered to any user');
			return FALSE;
		}
		return TRUE;
	}


	public function index()
	{
		$this->not_loggedin_for_pw_recovery();
		$data['error'] = '';
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_exists');

		if($this->form_validation->run() === FALSE) {
			$data['title'] = 'Reset Password';
			$data['path'] = 'forgot_password/index';
			$this->load->view('templates/master', $data);
		} else {
			$email = trim($this->input->post('email'));
			$result = $this->forgotpassword_model->email_exists($email);
			if($result){
				$this->send_reset_password_email($email,$result->password, $result->username);
				$this->session->set_flashdata('pwrecover_message_to_email', "The Recovery link has been sent to {$email}.");
				redirect('users/login');
			}
		}

	}



	public function send_reset_password_email($email, $old_password, $username)
	{
		$this->not_loggedin_for_pw_recovery();
		$email_code = password_hash($old_password, PASSWORD_BCRYPT);
		$email_code = str_replace('/', '@', $email_code);
		$config = [
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.googlemail.com',
			  'smtp_port' => 465,
			  'smtp_user' => 'namoshi.test@gmail.com', // change it to yours
			  'smtp_pass' => '$password', // change it to yours
			  'charset' => 'utf-8',
			  'wordwrap' => TRUE,
			  'newline' => "\r\n"
			];
			$config['smtp_port'] = 465; 
$config['smtp_timeout'] = 5;
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['validate'] = FALSE;
$config['priority'] = 3;
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['bcc_batch_mode'] = FALSE;
$config['bcc_batch_size'] = 200;
//echo $this->config->item('bot_email');
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
		 
		$this->email->from('namoshi.test@gmail.com', 'Grafi');
		$this->email->to($email);
		$this->email->subject('Please reset your password at ciBlog');

		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html> <head>
		<meta http-equiv="Content-Type" content="text/html; charset-utf-8" /> 
		</head> <body>';

		$message = '<p>Dear User:' . $username . '</p>';
		//link will be type /forgotpassword/reset_password_form/emailaddress/emailcode

		$message .= '<p> We want to help you reset your password! please <strong><a href="' . base_url() . 'forgotpassword/reset_password_form/' . $email . '/' . $email_code . '"> Click Here</a> </strong> to reset your password. </p>';

		$message .= '<p> Thank you </p>';
		$message .= '</body></html>';

		$this->email->message($message);


		if($this->email->send())
	     {
	      	echo 'Email sent.';	      
	     }
	     else
	    {
	     	show_error($this->email->print_debugger());
	    }
	}




	public function reset_password_form($email, $email_code)
	{
		$this->not_loggedin_for_pw_recovery();
		if(isset($email, $email_code)) {
			$email = trim($email);
			$email_hash = sha1($email . $email_code);
			$verified = $this->forgotpassword_model->verify_reset_password_code($email, $email_code);
			if($verified) {

				$data = ['path' => 'forgot_password/update_password', 'email_hash' => $email_hash, 'email' => $email, 'email_code' => $email_code];

				$this->load->view('templates/master', $data);
			} else {
				$data = ['path' => 'forgot_password/index', 'title' => 'Reset Password', 'error' => 'There was a problem with your link.Please click it again or request to reset your password again', 'email' => $email];
				$this->load->view('templates/master', $data);
			}

		}
	}



	public function update_password($email,$email_code)
	{
		$this->not_loggedin_for_pw_recovery();
		if((!$this->input->post('email_hash') && !$this->input->post('email_code')) || $this->input->post('email_hash') !== sha1($this->input->post('email') . $this->input->post('email_code')))
		{
			//Either a hacker or they changed their email in the email field, just die.
			die('Error Updating your password');
		}

		$this->form_validation->set_rules('email_hash', 'Email Hash', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|trim');
		$this->form_validation->set_rules('new_password_again', 'Confirmed Password', 'required|trim|matches[new_password]');

		if($this->form_validation->run() === FALSE) {
			$email_hash = sha1($email . $email_code);
			$data = ['path' => 'forgot_password/update_password', 'email_hash' => $email_hash, 'email' => $email, 'email_code' => $email_code];
			$this->load->view('templates/master', $data);
		} else {

			$result = $this->forgotpassword_model->update_password();
			if($result) {

				$this->session->set_flashdata('recover_pw_updated', "Your password has been updated. You may log in now.");
				redirect('users/login');
			}
		}
	}


	
}