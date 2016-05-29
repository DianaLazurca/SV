<?php

Class Login extends CI_Controller{

	public function index() {

		//$this->load->view('login');
		$user = $this->session->userdata('user');

		if(!$user) {

			
			$this->form_validation->set_rules('username','username', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_message('required','%s is required');
			
			if($this->form_validation->run()){
				
				$this->load->model('get');
				$result = $this->get->login($this->input->post('username'),$this->input->post('password'));

				if ($result['type'] !== "Bad credentials") {
					if ($result['type'] == 1) {
						redirect('/adminPanel');
					} else {
						if ($result['type'] == 2) {
							redirect('/teacher');
						} else {
							redirect('/student');
						}
					}
				} else {
					// do something here
					//$this->form_validation->set_message('rule', 'Error Message');
					$user['error'] = $result['type'];
					$user['username'] = $this->input->post('username');
					$this->session->set_userdata('user', $user);
					$this->load->view('login');
					//print_r($user);
				}				

			} else {
				$this->load->view('login');	
			}
		} else {
			echo "No such user";
			redirect(base_url());
			
		}
	}




}

?>