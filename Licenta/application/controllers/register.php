<?php

Class Register extends CI_Controller{

	public function index() {

		$user = $this->session->userdata('user');

		if( !$user){

			$this->form_validation->set_rules('email','email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('repeatpassword', 'repeatpassword', 'required|matches[password]');
			$this->form_validation->set_rules('username', 'username','required');
			$this->form_validation->set_rules('motivation', 'motivation', 'required');
			$this->form_validation->set_message('required','%s is required');
			$this->form_validation->set_message('matches','Paswwords must match');

			if($this->form_validation->run()){


				$this->load->model('set');
				$this->set->registerNewUser($this->input->post('email'),
											$this->input->post('password'),
											$this->input->post('motivation'),
											$this->input->post('username'),
											date('Y-m-d H:i:s'));				
			}else{

				$this->load->view('register');
			}
		}else{
			redirect(base_url());
		}
	}
}

?>