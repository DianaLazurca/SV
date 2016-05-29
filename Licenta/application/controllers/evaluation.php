<?php

Class Evaluation extends CI_Controller {

	public function index() {

		$user = $this->session->userdata('user');

		if ($user) {
			$this->load->view('evaluation');
		}
	}
}