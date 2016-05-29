<?php

class SetForum extends CI_Model {
	
	public function insertNewGuest($data){
		$CI = &get_instance();
		$this->forum = $CI->load->database('forum', TRUE);
		
		$this->forum->insert('users',$data);

		$this->session->set_userdata('user',$data);
	}

	public function insertNewPost($data){
		$CI = &get_instance();
		$this->forum = $CI->load->database('forum', TRUE);
		$this->load->helper('date');
		$data['date_time'] = date('Y-m-d H:i:s'); 
		
		$this->forum->insert('posts',$data);

		$this->session->set_userdata('user',$data);
	}

}
?>