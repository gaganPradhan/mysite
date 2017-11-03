<?php
class Forgotpassword extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('form');		
		$this->load->model('Forgotpassword_model');
	}

	public function index(){
		$data = [
			'path' => 'forgotpassword/index',
			'title' => 'Password Recovery'
		];

		if($this->logged_in()){
			$this->session->set_flashdata('login', 'You are already logged in');
			redirect('', 'refresh');
		}
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_user_exists');
		if($this->form_validation->run() == TRUE){
			$email = $this->input->post('email');
			$user_data = $this->Forgotpassword_model->user_exists();
			$this->Forgotpassword_model->send_reset_password_email($email, $user_data->username);
			$this->session->set_flashdata('email', "Reset link has been sent to {$email}.");
			redirect('users/login', 'refresh');			
		}
		$this->load->view('templates/master', $data);
	}

	function change($token){

	}

	function user_exists($email){
		if(!$this->Forgotpassword_model->user_exists()){
			$this->form_validation->set_message('user_exists', 'This email does not have a account');
	   	     return FALSE;
		}
		return TRUE;		
	}
}