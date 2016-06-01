<?php

Class Test extends CI_Controller {

	public function index() {
		$user = $this->session->userdata('user');

		if ($user) {
			$this->load->view('test');
		}
	}

	public function id($id) {

		$user = $this->session->userdata('user');

		if ($user) {
			$this->load->model('get');
			$data["test"] = $this->get->getTestById($id)["Location"];
			echo $id;
			//$this->load->view('test', $data);
		}
	}

	public function remove() {
		$user = $this->session->userdata('user');
		// check if the creator of the test is user
		if ($user) {
			$testID = $this->input->post('id');

			$this->load->model('get');
			$test = $this->get->getTestById($testID);

			if ($test['id'] == $testID) {
				if ($test['user_id'] == $user['id']) {

					$this->load->library('filelibrary');
					$this->load->model('get');
					$logs = $this->get->getAllLogsForTestId($testID);

					foreach ($logs as $log) {
						if ($log['testID'] == $testID) {
							//chmod(uploadURL, 777);
							$location = $this->filelibrary->replaceFromHosttoLocal($log['location']);
								
							if ($this->filelibrary->deleteFile($location) != 1) {
								echo "[LOG] problem with deleting ";
							}
						}
					}
					$testLocationServer = $log['location'];
					$testLocationLocal = $this->filelibrary->replaceFromHosttoLocal($testLocationServer);
					if ($this->filelibrary->deleteFile($testLocationLocal) != 1) {
						echo "[JSON] problem with deleting ";
					}

					$this->load->model('get');
					$testOtherFormats = $this->get->getAllFormatsForTestId($testID);

					foreach ($testOtherFormats as $testOtherFormat) {
						$location = $this->filelibrary->replaceFromHosttoLocal($testOtherFormat['Location']);
						$folderLocation = $location;
						if ($this->filelibrary->deleteFile($location) != 1) {
								echo "[FORMATS] problem with deleting ";
						}
					}
					$folderLocationLocal = explode(".", $folderLocation)[0];
					
					if ($this->filelibrary->delTree($folderLocationLocal) != 1) {
						echo "[DIRECTORY] problem with deleting ";
					}

					//stergem din baza de date
					$this->load->model('set');					
					$this->set->deleteTest($testID);

				}
			}
			
			
		}

	}

	public function getLogData() {

		$user = $this->session->userdata('user');

		if ($user) {
			$testLocation = $this->input->get('location');
			$data = file_get_contents($testLocation);

			print_r($data);
		}
	}

	public function evaluation($id) {

		$user = $this->session->userdata('user');
		if ($user) {

			$this->load->model('get');
			$result["data"] = json_encode($this->get->getAllLogsForTestId($id));

			$this->load->view('evaluation', $result);
		}
		
	}

	public function getAllLogsForTestId() {
		$user = $this->session->userdata('user');

		if ($user) {
			$id = $this->input->get('id');
			
			$this->load->model('get');
			$result = $this->get->getAllLogsForTestId($id);

			echo json_encode($result);
		}
	}

	public function getEvaluations() {

		$user = $this->session->userdata('user');
		if ($user) {

			$testID = $this->input->post('id');
			$this->load->model('get');
			$result = $this->get->getAllLogsForTestId($id);
			redirect('/evaluation', $result);
		}

	}

	public function getStatisticsForQuestion() {
		$user = $this->session->userdata('user');

		if ($user) {
			$id = $this->input->get('testID');
			$questionid = $this->input->get('questionID');
			$nrOfAnswers = $this->input->get('nrOfAnswers');
			
			$this->load->model('get');
			$result = $this->get->getAllLogsForTestId($id);
			if (count($result) == 0) {
				echo json_encode("{'error': 'No logs for test'}");
			} else {
				$this->load->library("statistics");
				$returnedResult = $this->statistics->generateStatisticsForQuestion($questionid, $result, $nrOfAnswers);
				echo json_encode($returnedResult);
			}
			
			
		}
	}

	public function generateAndUpdateNewPasswordForTest() {

		$testid = $this->input->get('id');

		$this->load->library('passwordgenerator');
		$newPassword = $this->passwordgenerator->generateUniqueTestLogIdentifier();

		$this->load->model('set');
		$this->set->updatePasswordTestPair($testid, $newPassword);

		echo json_encode($newPassword);

	}

	public function generateNewPasswordForTest() {

		$testid = $this->input->get('id');

		$this->load->library('passwordgenerator');
		$newPassword = $this->passwordgenerator->generateUniqueTestLogIdentifier();

		$this->load->model('set');
		$this->set->insertNewPasswordTestPair($testid, $newPassword);

		echo json_encode($newPassword);
		
	}
	public function getKeyForTest() {
		$id = $this->input->get('id');
		$this->load->model('get');
		echo json_encode($this->get->getKeyForTest($id));
	}

	public function getTestById() {
			
		$id = $this->input->get('id');
		$this->load->model('get');
		echo json_encode($this->get->getTestById($id));
	
	}

	public function getAllTests() {
			
		$this->load->model('get');
		echo json_encode($this->get->getAllTests());
	
	}

	public function sendTestLog() {
		$testLog = $this->input->post();
		

		$user = $this->session->userdata('user');


    	$this->load->library('passwordgenerator');
    	$uniqueIdentifier = $this->passwordgenerator->generateUniqueTestLogIdentifier();

		$this->load->model('get');
		$testName = $this->get->getTestById($testLog["testAnswers"]["test-id"])["Name"];

		$params  = array('testLog' => $testLog, 'testName' => $testName, 'username' => $user['username'], 'uniqueIdentifier' =>$uniqueIdentifier);


		$this->load->library('filelibrary');
		$fileName = $this->filelibrary->fromArrayToJson($params);

		$mt = explode(' ', microtime());
        $date = $mt[1] * 1000 + round($mt[0] * 1000);

		$this->load->model('set');
		$this->set->insertLog($testLog["testAnswers"]["test-id"], $uniqueIdentifier, $fileName, $user["username"], $date);
		
		print_r( $testLog);
		//echo $testName;
		
	}
}
?>