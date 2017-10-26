<?php

class Requests extends CI_Controller {
	public function index(){
		$data = ['title' => 'Request List', 'path'=>'requests/index', 'users' => $this->Request_model->getRequests()];       
        $this->load->view('templates/master', $data);        
	}

	public function view($id = null) {
		$data = ['title' => 'Request Detail', 'path' => 'requests/view', 'users' => $this->Request_model->getRequests($id)];
		if(empty($data)){
			show_404();
		}
		$this->load->view('templates/master', $data);
	}
}