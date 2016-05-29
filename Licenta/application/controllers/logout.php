<?php 

Class Logout extends CI_Controller {

	public function index() {

		$this->session->unset_userdata('user');
		redirect(base_url('login'));

	}

}

?>