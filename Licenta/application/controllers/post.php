<?php
	Class Post extends CI_Controller {

		public function addPost() {
			$user = $this->session->userdata('user');
			$content = $this->input->post('content');

			//add the user in the database

			$data['user_id'] = $user['session_id'];
			$data['content'] = $content;

			$this->load->model('setForum');
			echo $this->setForum->insertNewPost($data);
		}
	}

?>