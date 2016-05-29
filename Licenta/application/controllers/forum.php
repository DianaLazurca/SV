<?php
	Class Forum extends CI_Controller {

		public function index() {
			$session_id = $this->session->all_userdata()['session_id'];
			$this->load->model('getForum');

			if (!$this->getForum->checkIfSessionExists($session_id)) {
				$this->load->library('passwordgenerator');
				$username = $this->passwordgenerator->generateUsername();
				$data['session_id'] = $session_id;
				$data['username'] = $username;
				$this->load->model('setForum');
				$this->setForum->insertNewGuest($data);
			}

			
			print_r($this->getForum->getCommentsForPostById(2));
			$this->load->view('forum');
			
		}

		public function getAllPosts() {
			$this->load->model('getForum');
			print_r($this->getForum->getAllPosts());

		}
	}

?>