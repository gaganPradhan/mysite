<?php

class Requests extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$data = [
				'title'   => 'Request An Inventory',
				'path'    => 'requests/index',
				'request' => $this->Request_model->has_request(),
				'notification' => $this->Request_model->has_notification()
				];
		if($this->Request_model->has_notification() && $this->session->has_userdata('username')){
			$this->session->set_flashdata('notification', 'Your previous request was acknowledged');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');
		$this->form_validation->set_rules('detail', 'Detail', 'required|min_length[6]');
        try{
			if($this->form_validation->run() === FALSE){					
				
			}else{
				$this->Request_model->set_request();
				redirect('requests/list','refresh');				
		    }
		}catch(Exception $e){
			die('Request not registered'. $e->getMessage());
		}
		$this->load->view('templates/master', $data);
	}
       

	public function view($id = null) {
		$data = ['title' => 'Request Detail', 'path' => 'requests/view', 'users' => $this->Request_model->get_request($id)];		
        if($this->input->post('submit')){        	
        	$this->Request_model->update_request();
        	redirect('list', 'refresh');
        }
        if(empty($data['users'])){
			show_404();
		}
		$this->load->view('templates/master', $data);
	}

	public function list() {
		$data = [
			'title' => 'Request List', 'path'=>'requests/list', 
			'completed_requests' => $this->Request_model->get_requests_list('completed'), 
			'cancelled_requests' => $this->Request_model->get_requests_list('cancelled'), 
			'pending_requests' => $this->Request_model->get_requests_list('pending')
		];   
		$this->load->view('templates/master', $data);  
	}
}