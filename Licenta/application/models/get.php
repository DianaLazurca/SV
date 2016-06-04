<?php

class Get extends CI_Model {


	public function getAllTests() {
		$result = $this->db->get('tests');
		return $result->result_array();
	}

	public function getAllLogsForTestId($id) {
		$this->db->where('testId',$id);
		return $this->db->get('logs')->result_array();
	}

	public function getAllFormatsForTestId($id) {
		$this->db->where('test_id',$id);
		return $this->db->get('testsotherformats')->result_array();
	}

	public function getEvaluationForLogId($id) {
		$this->db->where('log_id', $id);
		return $this->db->get('evaluations')->result_array();
	}

	public function getKeyForTest($id) {
		$this->db->where('testID',$id);
		$query = $this->db->get('passwordsfortests');

	    if ($query->num_rows() > 0) {
	    	$query = $query->result_array();
	    	return $query[0]["password"];
	    }
		return null;
	}

	public function getMaxTestId() {
		$this->db->select_max('id');
		$query = $this->db->get('tests');

	    if ($query->num_rows() > 0) {
	    	$query = $query->result_array();
	    	return $query[0]["id"] + 1;
	    }
		return 1;
	}

	public function getNewsFeed($offset) {

		$user = $this->session->userdata('user');



		$this->db->select('firstUserID');
		$this->db->where('secondUserID', $user['id'] );
		$result = $this->db->get('friends');

		$result = $result->result_array();

		$this->db->select('secondUserID');
		$this->db->where('firstUserID', $user['id']);
		$result += $this->db->get('friends') -> result_array();

		if($result == null) {
			$result = array();
			array_push($result,$user['id']);
		}

		if(sizeof($result) > 0) {
			
			$this->db->select('posts.content,posts.datetime,users.firstName,users.lastName,posts.postID')->from('posts');
			$this->db->where_in('userID', $result[0] );
			$this->db->join('users','users.id=posts.userID');
			$this->db->limit(1, $offset);
			$result = $this->db->get();
			$result = $result->result_array();

			if(sizeof($result) > 0)
				return $result;
		} 
		
		return null;

		
	}

	public function getTestById($id) {
		$this->db->where('id', $id);
		$result = $this->db->get("tests");

		if ($result->num_rows() > 0) { 
			$result = $result->result_array();				
			return $result[0];
		} else {
			return $result =  array('location' => 'invalid');
		}

	}


	
	public function login($username, $password){
				
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$result = $this->db->get('users');


		if( $result->num_rows() > 0 ){
			//echo "Da";
			$user = array();
			$result = $result->result_array();
			
			$user['id']=$result[0]['id'];
			$user['username']=$result[0]['username'];
			$user['type']=$result[0]['type'];

			$this->session->set_userdata('user',$user);

			/*if ($result[0]['type'] == 1) {
				$this->load->view('adminPanel');
			} else {
				if ($result[0]['type'] == 2) {
					$this->load->view('teacher');
				} else {
					$this->load->view('student');
				}
			}*/
			return $user;
		} else {
			//check if the password isn't the id of a  test + set the session test id. If not => bad credentials :D
			//check in the tests table
			$this->db->where('password', $password);
			$result = $this->db->get('passwordsfortests');

			if ($result->num_rows() > 0) {
				$user = array();
				$result = $result->result_array();

				$user['username'] = $username;
				$user['type'] = 'student';
				$user['testID'] = $result[0]['TestID'];

				$this->session->set_userdata('user',$user); 

				return $user;
			}
			return $result = array('type' => "Bad credentials" );
		}
				
	}

	public function getComments( $postID){


	  $newResult[] = null;
	  $this->db->where('postID',$postID);
	  $result = $this->db->get('comments')->result_array();

	  if( $result == null){

	   echo "Post-ul " . $postID . "nu are comentarii";
	  }else{
	   for( $i = 0 ; $i < count($result); $i++){

	    //print_r($result[$i]); echo "<br>";
	    $userID = $result[$i]['userID'];


	    $this->db->select('firstName,lastName');
	    $this->db->where('id',$userID);
	    $user = $this->db->get('users')->result_array();

	    //print_r($user[0]); echo "<br>";
	    $newResult[$i]['name'] = $user[0];
	    $newResult[$i]['comment'] = $result[$i]['content'];
	    $newResult[$i]['datetime'] = $result[$i]['datetime'];
	   }
	  }
	  
	  //print_r($newResult); echo "<br>";
	  return $newResult;
 }

	public function comments(){

		$this->db->limit(100);
		$this->db->order_by('datetime','desc');
		$result = $this->db->get('comments');

		return $result->result_array();
	}

	public function comment($id){

		$this->db->where('comments.postID',$id);
		$this->db->join('users','users.id=comments.userID');
		$result = $this->db->get('comments');

		$result = $result->result_array();
		unset($result['password']);
		return $result;
	}

	public function updateComments($id,$offset) {
		
		$this->db->where('comments.postID',$id);
		$this->db->join('users','users.id=comments.userID');
		$this->db->limit(1, $offset);
		$result = $this->db->get('comments');

		$result = $result->result_array();
		return $result;
	}

		public function recommandedFriends($id){

		$altceva[] = null;
		$recom[] = null;
		$result = $this->friends($id);

		$index[$id]=$id;
		for( $i = 0; $i < count($result); $i++){

			$index[$result[$i]['id']] = $result[$i]['id'];
						
			$friends = $this->friends($result[$i]['id']);
				
				$copieFriends = $friends;
				for ( $j = 0 ; $j < count($copieFriends) ; $j++){
						
						if( array_key_exists($friends[$j]['id'], $index) == 1){
							
							unset($friends[$j]);
						}else{

							$index[$friends[$j]['id']] = $friends[$j]['id'];	
							$recom[$j] = $friends[$j];
							
							
						}
					
					
				}
	
		}
	}

	public function friends($id){

		//echo "Id-ul meu "; echo $id;
     $this->db->select('firstUserID');
	 $this->db->where('secondUserID', $id );
	 $result1 = $this->db->get('friends')->result_array();

	 $friends[] =null ;
	 $friend = null;

	 $this->db->select('secondUserID');
	 $this->db->where('firstUserID', $id);
	 $result2 = $this->db->get('friends') -> result_array();
	 

	 //print_r(array_merge( $result1,$result2));
	 /*echo " finall ";
	 var_dump($results);*/

	 for( $i = 0; $i < count(array_merge( $result1,$result2)); $i++){

	 		//echo "i::::"; echo $i;
			//echo "<br>";
			//print_r(array_merge( $result1,$result2)[$i]);
	 		if (array_key_exists('secondUserID', array_merge( $result1,$result2)[$i])){

	 			$friendID = array_merge( $result1,$result2)[$i]['secondUserID'];
	 			//echo $friendID;
	 		}

	 		if (array_key_exists('firstUserID', array_merge( $result1,$result2)[$i])){

	 			$friendID = array_merge( $result1,$result2)[$i]['firstUserID'];
	 			//echo $friendID;
	 		}

	 		$this->db->select('users.id,users.firstName, users.lastName');
		 	$this->db->where('users.id',(int)$friendID);
		 	$friend = $this->db->get('users')->result_array();


		 	//var_dump($friend[0]);
		 	$friends[$i] = $friend[0];

		 	//echo "<br>"; echo "<br>";echo "<br>";


		}
		//var_dump($friends);
 		return $friends;
	}



}


?>