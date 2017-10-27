<?php

class Users extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');		
		$this->load->library('upload');
		$this->load->model('User_model');
		$this->load->library('encryption');

	}

	public function index() {       
        $data = [
        		'title' => 'User List',
        		'path'  => 'users/index',
        		'users' => $this->User_model->get_users()
        		];       
        $this->load->view('templates/master', $data);
        }

	public function view($id = NULL){
		$data = [
				'title' => 'User Detail',
				'path'  => 'users/view',
				'users' => $this->User_model->get_users($id)
				];
		if(!is_numeric($id)){
			show_404();
		}		
		if(empty($data['users'])) {
			show_404();
		}				
		$this->load->view('templates/master', $data);
	}	

	public function create(){	
		$data = [
				'title' => 'Create User profile',
				'path'  => 'users/create'
				];
		$this->form_validation->set_message('is_unique','{field} already exists');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|callback_regex_check|max_length[32]|is_unique[users.username]');
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|callback_regex_check|max_length[32]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('passconf', 'Confirmation Password', 'required|matches[password]');
		$config['file_name']     = $this->input->post('time').'_'.$this->input->post('username').$this->upload->data('file_ext');
		$config['upload_path']   = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '2024';
		$config['max_width']     = '1024';
		$config['max_height']    = '768';
        $this->upload->initialize($config);	
        try{
			if($this->form_validation->run() === FALSE || $this->upload->do_upload('image') === FALSE){
				$error = array('error' => $this->upload->display_errors());
		        $data['errors'] = $error; 	
				$this->load->view('templates/master', $data);
			}else{				
		        $data = array('upload_data' => $this->upload->data());echo "success";
		        $this->User_model->set_user();
			    redirect('users', 'refresh');
		    }
		}catch(Exception $e){
			die('File not uploaded'. $e->getMessage());
		}
	}

	public function login(){
		$data = array(
			'path' => 'users/login',
			'log' => $this->User_model->logged_in());
      	if($this->input->post('loginSubmit')){
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');	
		}if($this->form_validation->run() === FALSE){								
			}else{
				$slug = $this->User_model->login_valid();
				if($slug){					
					$this->session->set_userdata('username', $this->input->post('username'));
					$this->session->set_flashdata('login', 'You are logged in');
					redirect('', 'refresh');	
				}else{
					$this->session->set_flashdata('login', 'Incorrect');
				}
			}
		$this->load->view('templates/master', $data);
	}

	public function logout(){
		$this->session->unset_userdata('username');
		redirect('users/login', 'refresh');
	}
	
	public function account($slug = NULL){
		if($slug == NULL){
			$slug = $this->User_model->logged_in();
			if($slug){
				redirect('users/account/'.$slug.'/', 'refresh');
			}else{
				show_404();
			}
		}else{
			$user_slug = $this->User_model->logged_in();
			if($slug !== $user_slug){
				show_404();
			}
		}
		$data = [		
					'path'  => 'users/account',
					'users' => $this->User_model->get_users($slug)
				];
		$this->load->view('templates/master', $data);
	}

	public function regex_check($userName) {
	  if (preg_match("/^[A-Za-z0-9]+(?:[_][A-Za-z0-9]+)*$/", $userName ) ) 
	  {	  
	    return TRUE;
	  } 
	  else 
	  {
        $this->form_validation->set_message('regex_check', 'The %s field contains invalid characters!');
	    return FALSE;
	  }
	}
}