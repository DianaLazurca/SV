<?php
Class Teacher extends CI_Controller {

	public function index() {
		$this->load->view('teacher');	
	}

	public function download() {
		// modify to receive test-ID or file location
		$this->load->helper('download');
		$data = file_get_contents(base_url() . "/assets/testsjson/ceva.xml"); // Read the file's contents
		$name = 'ceva.xml';

		force_download($name, $data);

	}

	public function saveClassification() {
		$user = $this->session->userdata('user');
		if ($user) {
			$postData = $this->input->post('data');
			$log_id = $postData['log_id'];
			$this->load->model('get');
			$result = $this->get->getEvaluationForLogId($log_id);
			
			
			$date = date('Y-m-d H:i:s', time());						

			if (count($result) > 0) {
				//vezi daca trebuie update sau nimic
				for ($index = 0; $index < count($result); $index ++) {
					if ($result[$index]['type'] === 'm') {
						if ($result[$index]['evaluation'] !== $postData['man']['evaluation']) {
							$data['evaluation'] = $postData['man']['evaluation'];
							$data['date'] = $date;
							$this->load->model('set');
							$this->set->updateEvaluation($log_id, $data);
						}
					}
				}
			} else {
				// inseareaza in db 
				if ($postData['man']['evaluation'] !== '' && $postData['man']['evaluation'] !== '-') {
					$this->load->model('set');
					$data['log_id'] = $log_id;
					$data['type'] = 'm';
					$data['date'] = $date;
					$data['evaluation'] = $postData['man']['evaluation'];
					$this->set->saveEvaluation($data);
				}
				
			}
			print_r($date);
		}
	}

	public function uploadFile() {

		$user = $this->session->userdata('user');

		$creator = $user["username"];

		var_dump($_POST);
		echo $this->input->post('response');

		$this->load->view('teacher');
		/*$fileName = $this->input->post('name');
		$config['upload_path'] = 'F:/xampp/htdocs/Licenta/assets/uploads/';
        $config['allowed_types'] = 'xml|pdf|docx|doc';
        $config['max_size'] = 1024 * 10;
        $config['encrypt_name'] = FALSE;
        $file_element_name = 'userfile';
		
		$this->load->library('upload',$config);

		if ( !$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			
		}
		else {
			$data = array('upload_data' => $this->upload->data());

			$testName = explode('.', $data["upload_data"]["file_name"]);
			$date = explode(' ', microtime());
			$creator = $user["username"];
			$milliseconds = $date[1] * 1000 + round($date[0] * 1000);
			$category = 'category Y';

			$testID = 0; 

			while($testID == 0) {
				
				$this->load->model('set');
			    $testID = $this->set->insertTest($testName[0], $creator, $category, $milliseconds);

				$this->load->model('get');
				$testID = $this->get->getMaxTestId();

			}		

			$credentials = array('fileLocation' => $data["upload_data"]["full_path"], 
								 'creator' => $creator,
								  'test-id' => $testID - 1,
								  'date' => $milliseconds,
								  'testName' => $testName[0],
								  'testExtension' => $testName[1],
								  'category' => $category);
			
			$this->load->library('filelibrary');
			$result = $this->filelibrary->transformFileInJSON($credentials);
			redirect('/teacher');
		}	
		$this->load->view('teacher', $error);	*/
	}
}

