<?php

class Home extends CI_Controller {

	public function index() {
		$this->load->view('home');
	}

	public function retrieveNewsFeed($offset) {
		$this->load->model('get');
		$result = $this->get->getNewsFeed($offset); 
		if(sizeof($result) > 0) {
			$this->	parseData($result);
			//print_r($result);
		}
	
	}

	private function parseData($data) {
		$var = null;
		foreach ($data as $post) {
			$commNo = $this->getCommentsNo($post['postID']);
			$var = '<li>';
			$var .= '<h3>' . $post['firstName'] . ' ' . $post['lastName'] . '</h3>';
			$var .= '<p>' . $post['content'] . '</p>';
			$var .= '<span class="timestamp">' . date("F j, Y, g:i a", strtotime($post['datetime'])) . '</span>';
			if($commNo > 0) { 
				$var .='<a href = ' . base_url('showPost/getPostInfo/' . $post['postID'])  . '>';
				$content = '<span class="commentsNumber">Comments (' .  $commNo . ')</span>';
				$var .= $content . '</a>';
			} else {
				$var .='<a href = ' . base_url('showPost/getPostInfo/' . $post['postID'])  . '>';
				$content = '<span class="commentsNumber">No comments</span>';
				$var .= $content . '</a>'; 
			}
			$var .= '<br></li>';
			
		}
		echo $var;
	}

	private function getCommentsNo($postID) {
		//folosinf postID, retrive commentsNumber
		$this->load->model('get');
		$result = $this->get->comment($postID);

		return sizeof($result);
	}
	
}



?>