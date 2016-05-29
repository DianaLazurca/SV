<?php
require('F:/xampp/htdocs/Licenta/application/libraries/REST_Controller.php');
Class Api extends  REST_Controller {

	function __construct() {
		parent::__construct();
	}

	function student_get() {       
        $this->response("Meeergeee baaaaa");

    }

    function response_post() {     
    	$response = $this->input->post("response");
    	$user_id = $this->input->post("user_id");
    	$jsonResponse = json_decode($response, true);
        $creator = $this->input->post("creator");
        $fileName = $jsonResponse["name"];
        $date = $jsonResponse["date"];
        $file = $jsonResponse["file"];
        $fileLocation = uploadURLFiles . $creator . "/";

		$category = "School Violence";

		foreach ($file as $pair) {
			foreach ($pair as $key => $value) {
				if ($key === 'json') {					

					$this->load->model('set');
			    	$this->set->insertTest($fileName, $creator, $category, $date, $user_id);

			    	$this->load->model('get');
					$testID = $this->get->getMaxTestId();

					$jsonString = file_get_contents($fileLocation . $value);
					$data = json_decode($jsonString, true);
					$data["test_id"] = $testID - 1;

					$newJsonString = json_encode($data);
					file_put_contents($fileLocation . $value, $newJsonString);
				}
			}			
		}

		

		foreach ($file as $pair) {
			foreach ($pair as $key => $value) {
				if ($key !== 'json') {
					$this->load->model('set');
			    	$this->set->insertTestOtherFormats($value, $testID - 1, $key, $creator);
				}
			}			
		}
		

    }
}