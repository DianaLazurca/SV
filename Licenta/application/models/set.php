<?php
Class Set extends CI_Model{
	

	public function registerNewUser($email, $password, $motivation, $username, $date){
	
		$data = array(
			'email'=>$email,
			'password' =>md5($password),
			'motivation' => $motivation,
			'username' => $username,
			'date' => $date	
			);
		$this->db->insert('registerNotifications',$data);
	}

	public function updatePasswordTestPair($testid, $newPassword) {
		
		$data = array('password' => $newPassword);
		
		$this->db->where('testID', $testid);
		$this->db->update('passwordsfortests',$data);
	}

	public function insertNewPasswordTestPair($testid, $newPassword) {

		$data = array(
			'testID' => $testid,
			'password' => $newPassword);
		$this->db->insert('passwordsfortests',$data);
	}

	public function insertTest($fileName, $creator, $category, $milliseconds, $user_id) {

		
			$data = array( 
				'Creator' => $creator,
				'Location' => base_url() . "assets/uploads/" .$creator."/". $fileName . ".json",	
				'Category' => $category,
				'CreationDate' => date('Y-m-d', $milliseconds/1000),
				'Name' => $fileName,
				'User_id' => $user_id
				);

		    $this->db->insert('tests',$data);	
	}

	public function insertTestOtherFormats($fileName, $testID, $format, $creator) {

		
			$data = array( 
				'Location' => base_url() . "assets/uploads/" .$creator."/". $fileName,
				'Test_id' => $testID,
				'format' => $format
				);

		    $this->db->insert('testsotherformats',$data);	
	}

	public function saveEvaluation($data) {
		$this->db->insert('evaluations',$data);
	}

	public function updateEvaluation($log_id, $data) {

		$this->db->where('log_id', $log_id);
		$this->db->update('evaluations',$data);
	}

	public function insertLog($testID, $uniqueIdentifier, $fileName, $username, $date) {

		$data = array(
			'testID'=>$testID,
			'password' => $uniqueIdentifier,
			'location' => base_url() . "assets/logs/" . $fileName . ".json",
			'username' => $username,
			'date' => 	date('Y-m-d', $date/1000)
			);
		$this->db->insert('logs',$data);
	}

	public function deleteTest($id) {

		$this->db->delete('testsotherformats', array('test_id' =>  $id));
		$this->db->delete('passwordsfortests', array('TestID' =>  $id));
		$this->db->delete('logs', array('testID' =>  $id));
		$this->db->delete('tests', array('id' =>  $id));

	}

	public function insert_post($userID, $content) {
		$data = array(
				'userID' => $userID,
				'content' => nl2br($content), //transforma newline in 2 br :))
				'datetime' => date('Y-m-d H:i:s', time() )
			);
		$this->db->insert('posts', $data);
		redirect(base_url());
	}

	
	public function insert_comment($userID, $postID, $content) {
		$data = array(
				'userID' => $userID,
				'postID' => $postID,
				'content' => nl2br($content), //transforma newline in 2 br :))
				'datetime' => date('Y-m-d H:i:s', time() )
			);
		$this->db->insert('comments', $data);
		redirect(base_url('showPost/getPostInfo') . '/' . $postID);
	}

	public function addFriend($id,$friend){

		$data = array(
			'firstUserID'=>$id,
			'secondUserID' =>$friend			
			);
		$this->db->insert('friends',$data);

	}

	public function deleteUser($id, $friend){

		$this->db->delete('friends', array('firstUserID' => $id, 'secondUserID' => $friend));
		$this->db->delete('friends', array('firstUserID' => $friend, 'secondUserID' => $id));
	}
	
	public function deletePost($postID){
		
		
		$this->db->where('postID', $postID);
		$this->db->delete('posts');

		$this->db->where('postID', $postID);
		$this->db->delete('comments');
	}

}

?>