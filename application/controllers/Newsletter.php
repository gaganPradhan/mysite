<?php

class Newsletter extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Newsletter_model');
		$this->load->helper('form');
		$this->load->library('upload');	
	}

	public function index(){
		$news = $this->Newsletter_model->show_news();
		$data = [
			'path' => 'newsletter/index',
			'newsletters' => $news,
			'title' => 'newsletter'

		];
		$this->load->view('templates/master.php', $data);
	}

	public function post() {
		$data = [
			'title' => 'Post A News',
			'path' => 'newsletter/post'
		];
		$this->form_validation->set_rules('title', 'Title', 'required|min_length[2]');
		$this->form_validation->set_rules('body', 'Body', 'required|min_length[6]');
		$config['file_name']     = time().'_'.$this->input->post('title').$this->upload->data('file_ext');
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
		        $this->Newsletter_model->add_news($image);
		        $this->session->set_flashdata('register', 'Post has been uploaded.');
			   	redirect('newsletter', 'refresh');
		    }else{
		    	$this->load->view('templates/master', $data);
		    }
		}catch(Exception $e){
			die('File not uploaded'. $e->getMessage());
		}
	}

	public function view($id){
		$news = $this->Newsletter_model->show_news($id);
		$data = [
			'path' => 'newsletter/view',
			'news' => $news,
			'title' => 'newsletter'

		];
		$this->load->view('templates/master.php', $data);
	}

	public function delete($id = NULL){
		$data = [
			'title' => 'Delete News',
			'path'  => 'newsletter/delete'
		];	
		if($this->input->post('delete')){
			
				$this->Newsletter_model->delete_news($id);
				$this->session->set_flashdata('delete', 'News deleted successfully.');
				
				redirect('', 'refresh');
				
		}else if($this->input->post('no')){
			redirect('newsletter/'.$id, 'refresh');
		}
		
		$this->load->view('templates/master', $data);
	}
}