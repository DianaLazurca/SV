<?php

class GetForum extends CI_Model {

	public function checkIfSessionExists($session_id){
		$CI = &get_instance();
		$this->forum = $CI->load->database('forum', TRUE);
		
		$this->forum->where('session_id',$session_id);
		$query =  $this->forum->get('users');

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllPosts(){
		$CI = &get_instance();
		$this->forum = $CI->load->database('forum', TRUE);

		$this->forum->limit(100);
		$this->forum->order_by('date_time','desc');
		$result = $this->forum->get('posts');

		$result = $result->result_array();

		
		for( $i = 0; $i < count($result); $i++){				
			
			$userID = $result[$i]['user_id'];
			
			$this->forum->select('username');
			$this->forum->where('session_id',$userID);
			$newResult = $this->forum->get('users')->result_array();
			
			$otherResult[$i]['post_id'] = $result[$i]['id'];
			$otherResult[$i]['username'] = $newResult[0]['username'];
			$otherResult[$i]['content'] = $result[$i]['content'];
			$otherResult[$i]['date_time'] = $result[$i]['date_time'];
		}

		//print_r($otherResult); echo "<br>";
		return $otherResult;
	}

	public function getCommentsForPostById($id) {
		$CI = &get_instance();
		$this->forum = $CI->load->database('forum', TRUE);

		$this->forum->where('comments.post_id',$id);
		$this->forum->join('users','users.session_id=comments.user_id');
		$result = $this->forum->get('comments');

		$result = $result->result_array();
		unset($result['password']);
		return $result;
	}

}
?>