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

	public function index($offset = 0) {   
	if(!$this->session->userdata('username') || !$this->session->userdata('status')){
		show_404();
	}    
        $data = [
        	'title' => 'User List',
        	'path'  => 'users/index',
        	'users' => $this->User_model->get_users()
        ];
        $this->load->view('templates/master', $data);
    }

	public function view($id = NULL){	
		$user_slug = $this->User_model->logged_in();
			if(!$user_slug){
				show_404();
			}	
		$data = [
			'title' 	 => 'User Detail',
			'path'  	 => 'users/view',
			'users'	     => $this->User_model->get_users($id),
			'department' => $this->User_model->get_departments($this->User_model->get_users($id)->dpt_id)
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
				'title'       => 'Create User profile',
				'path'        => 'users/create',
				'departments' => $this->User_model->get_departments()
				];
		$this->form_validation->set_message('is_unique','{field} already exists');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|callback_regex_check|max_length[32]|is_unique[users.username]');
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');
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
			if($this->form_validation->run() === TRUE){
				if($this->upload->do_upload('image') === FALSE){
					$error = array('error' => $this->upload->display_errors());
		        	$data['errors'] = $error; 
		        	$this->session->set_flashdata('error', $error['error']);
		        	$image = 'noimage.png';			        
					
				}else{				
		        	$data = array('upload_data' => $this->upload->data());
		        	$image = $this->upload->data('file_name');
		        }
		        $this->User_model->set_user($image);
		        $this->session->set_flashdata('register', 'Account has been Registered');
			   	redirect('', 'refresh');
		    }else{
		    	$this->load->view('templates/master', $data);
		    }
		}catch(Exception $e){
			die('File not uploaded'. $e->getMessage());
		}
	}

	public function login(){
		$data = array(
			'title' => 'Login',
			'path'  => 'users/login',
			'log'   => $this->User_model->logged_in());
      	if($this->input->post('loginSubmit')){
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');	
		}if($this->form_validation->run() === FALSE){								
			}else{
				$slug = $this->User_model->login_valid();
				if($slug){					
					$this->session->set_userdata('username', $this->input->post('username'));
					$this->session->set_flashdata('login', 'You are logged in');
					if($this->User_model->has_permission('admin', $this->input->post('username'))){
						$this->session->set_userdata('status' , 1);
						$this->session->set_flashdata('login', 'You are logged in as Admin');
					}					
					redirect('', 'refresh');	
				}else{
					$this->session->set_flashdata('login', 'Incorrect');
				}
			}
		$this->load->view('templates/master', $data);
	}

	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('status');
		$this->session->set_flashdata('login', 'Logged out successfully');
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
		$users = $this->User_model->get_users($slug);
		$data = [	
					'title'      => 'User Profile',	
					'path'       => 'users/account',
					'users'      => $users,
					'department' => $this->User_model->get_departments($users->dpt_id)
				];
		$this->load->view('templates/master', $data);
	}

	public function update($slug = NULL){	
		$user_slug = $this->User_model->logged_in();
			if(!$user_slug){
				show_404();
			}
		if($slug == 'pswrdchng'){
			$data = [
				'title'       => 'Change Password',
				'path'        => 'users/changepassword',
				'departments' => $this->User_model->get_departments(),
				'users'       => $this->User_model->get_users($user_slug)
				];
			$this->form_validation->set_rules('org_password', 'Old Password', 'required|callback_password_check');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
			$this->form_validation->set_rules('passconf', 'Confirmation Password', 'required|matches[password]');
			try{
				if($this->form_validation->run() == TRUE){	
					$this->User_model->password_change();
					$this->session->set_flashdata('update', 'Password has been updated successfully.');	
					redirect('users/account/'.$user_slug, 'refresh');
				}

			}catch(Exception $e){
				die('Cannot change password'. $e->getMessage());
			}
			$this->load->view('templates/master', $data);			

		}else{
		
			$data = [
					'title'       => 'Update User profile',
					'path'        => 'users/update',
					'departments' => $this->User_model->get_departments(),
					'users'       => $this->User_model->get_users($user_slug)
					];
			$original_username = $data['users']->username ;
			$original_image = $data['users']->image;
	    	if($this->input->post('username') != $original_username) {
	      		$is_unique =  '|is_unique[users.username]';
	    	} else {
	      		$is_unique =  '';
	    	}
	    	
			$this->form_validation->set_message('is_unique','{field} already exists');
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|callback_regex_check|max_length[32]'.$is_unique);
			$original_email = $data['users']->email ;
	    	if($this->input->post('email') != $original_email) {
	      		$is_unique =  '|is_unique[users.email]';
	    	} else {
	      		 $is_unique =  '';
	    	}
			$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[32]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email'.$is_unique);		
			$config['file_name']     = $this->input->post('time').'_'.$this->input->post('username').$this->upload->data('file_ext');
			$config['upload_path']   = './assets/images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']      = '2024';
			$config['max_width']     = '1024';
			$config['max_height']    = '768';
	        $this->upload->initialize($config);	
	       try{
				if($this->form_validation->run() === TRUE){
					if($this->upload->do_upload('image') === FALSE){
						$error = array('error' => $this->upload->display_errors());
			        	$data['errors'] = $error; 
			        	$this->session->set_flashdata('error', $error['error']);
			        	$image = $original_image;
					}else{
						if(strcasecmp($original_image, "noimage.png") != 0){
							unlink('assets/images/'.$original_image);
						}
			        	$data = array('upload_data' => $this->upload->data());
			        	$image = $this->upload->data('file_name');
			        }
			        $this->User_model->update_user($image);
			        $this->session->set_userdata('username', $this->input->post('username'));
			        $this->session->set_flashdata('update', 'Account has been updated successfully.');		        
				   	redirect('users/account/'.$this->input->post('username'), 'refresh');
			    }else{
			    	$this->load->view('templates/master', $data);
			    }
			}catch(Exception $e){
				die('File not uploaded'. $e->getMessage());
			}
		}
	}

	public function delete($id = NULL){
		$data = [
			'title' => 'Delete profile',
			'path'  => 'users/delete'
		];	
		if($this->input->post('delete')){
			if($id === NULL){
				$user_slug = $this->User_model->logged_in();
				$id = $user_slug;
			}			
				$this->User_model->delete_user($id);
				if(!is_numeric($id)){
					self::logout();	
				}
				$this->session->set_flashdata('delete', 'Account deleted successfully.');
				redirect('', 'refresh');
		}else if($this->input->post('no')){
			redirect('users/account/'.$this->session->userdata('username'), 'refresh');
		}
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

	public function password_check($password){
		$user = $this->session->userdata('username');
		$user = $this->User_model->get_users($user);
		$password = hash('sha256', $password.'grafi');
		if(strcmp($password, $user->password) == 0){
			return TRUE;
		}else{
			$this->form_validation->set_message('password_check', 'Incorrect Password');
	  		return FALSE;
		}
	}

}