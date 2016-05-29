<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class FileLibrary {

	public function replaceFromHosttoLocal($location) {
		$aaray = explode("/",$location);
							
		$location = uploadURL . "/";
		for ($i = 4; $i < count($aaray); $i ++) {
			$location .= $aaray[$i];
			if ($i != count($aaray) - 1) {
				$location .= "/";
			}
		}
		return $location;
	}

	public function deleteFile($location) {
		return unlink($location);
	}
	
	// return json name and the unique identifier 
    public function fromArrayToJson($array)
    {	
    	$testLog = $array["testLog"];
    	$testName = $array["testName"];
    	$testStartDate = $testLog["testAnswers"]["start-test"];
    	$username = $array["username"];    	
    	$uniqueIdentifier = $array['uniqueIdentifier'];

    	$fileName = $uniqueIdentifier . $username . $testName . $testStartDate;

    	//print_r($array);    	
    	$myfile = fopen( uploadURL . "/assets/logs/" . $fileName . ".json", "w") or die("Unable to open file!");
		fwrite($myfile, "{ " . "\n" . "\"test-id\" : " . $testLog["testAnswers"]["test-id"] . ",");
		fwrite($myfile, "\n" . "\"start-date\" : " . $testStartDate . ",");
		fwrite($myfile, "\n" . "\"finish-time\" : " . $testLog["testAnswers"]["finish-time"] . ",");
		fwrite($myfile, "\n" . "\"questions\" : \n[");

    	$questions = $testLog["testAnswers"]["questions"];

    	for ($i = 0; $i < count($questions); $i ++) {
    		$question = "{ \"question-id\" : " . $questions[$i]["question-id"] . ", ";
    		$question = $question . " \"text\" : \"" . $questions[$i]["text"] . "\", " ;
    		$question = $question . "\n\"answered-time\" : " 
    						. $questions[$i]["answered-time"] . ", \n \"answers\" : [ \n";
    		$answers = $questions[$i]["answers"];

    		for ($j = 0; $j < count($answers); $j ++) {
    			$answer = "{ \"answer-id\" : " . $answers[$j]["answer-id"] . ", \"text\" : \"" . $answers[$j]["text"] . "\"";
    			$answer = $answer . ", \"img\" : \"" . $answers[$j]["img"];
    			$answer = $answer . "\"}";

    			if ($j != count($answers) - 1) {
    				$answer = $answer . ",\n";
    			}

    			$question = $question . $answer;
    		}


    	    $question = $question . "]}"; //end answers + question
    	    if ($i != count($questions) - 1) {
    	    	 $question = $question . ",\n";
    	    }
    	    fwrite($myfile, $question);
    	}

    	fwrite($myfile, "\n]"); // close "questions"
    	fwrite($myfile, "\n}"); // end test
		fclose($myfile);

		return  $arrayName = $fileName;
    }

    public function transformFileInJSON($array) {
    	$fileLocation = $array["fileLocation"];
    	$creator = $array["creator"];
    	$testId = $array["test-id"];
    	$creationDate = $array["date"];
    	$testName = $array["testName"];
    	$testCategory = $array["category"];
    	$testExtension = $array['testExtension'];

    	$file = fopen($fileLocation, "r") or die("Unable to open file!");
    	$fileDoc = new DOMDocument();
    	
    	if ($testExtension == 'xml') {
			$fileDoc->load($fileLocation);
		}

		$jsonFile = fopen( uploadURL . "/assets/testsjson/" . $testName . ".json", "w") or die("Unable to open file!");

		fwrite($jsonFile, "{ " . "\n" . "\"test-id\" : " . $testId . ",");
		fwrite($jsonFile,  "\n" . "\"category\" : \"" . $testCategory . "\",");
		fwrite($jsonFile,  "\n" . "\"date\" : " . $creationDate . ",");
		fwrite($jsonFile,  "\n" . "\"creator\" : \"" . $creator . "\",");
		fwrite($jsonFile,  "\n" . "\"text\" : \"" . $testName . "\",");
		fwrite($jsonFile,  "\n" . "\"questions\" : [");

		if ($testExtension == 'xml') {
			$this->fromXMLToJSON($jsonFile, $fileDoc);
		}
		if ($testExtension == 'pdf') {
			$this->fromPDFToJSON($jsonFile, $fileLocation);
		}
		fwrite($jsonFile,  "\n]}"); //end questions and final bracket
    	return $testName;

    } 


    public function fromXMLToJSON($jsonFile, $xmlDoc) {
    	$questions = $xmlDoc->getElementsByTagName("question");
		$result = " ";
		for ($i = 0; $i < $questions->length; $i++) {
			 $question = $questions->item($i);
			 fwrite($jsonFile,  " { \n" . "\"question-id\" : " . $i . ",");
			 if ($question->hasChildNodes()) {
			 	$questionText = $question->getElementsByTagName('text')->length;
			 	for ($index = 0; $index < $question->getElementsByTagName('text')->length; $index++) {
			 		$questionText = $question->getElementsByTagName('text')->item($index)->nodeValue;
			 	}

			 	fwrite($jsonFile,  " \n" . "\"text\" : \"" . $questionText . "\",");
			 	fwrite($jsonFile,  " \n" . "\"images\" : [] ,");
			 	fwrite($jsonFile,  " \n" . "\"answers\" : [");
			 	$answers = $question->getElementsByTagName('answer');
			 	$result .= $questionText . "--";
			 	for ($index = 0; $index < $answers->length; $index++) {
			 		
			 		$answer = $answers->item($index)->nodeValue;
			 		fwrite($jsonFile,  " { \n" . "\"answer-id\" : " . $index . ",");
			 		fwrite($jsonFile,  " \n" . "\"text\" : \"" . $answer . "\",");
			 		fwrite($jsonFile,  " \n" . "\"images\" : []");

			 		if ($index == $answers->length - 1) {
			 			fwrite($jsonFile,  " \n}");
			 		} else {
			 			fwrite($jsonFile,  " \n},");
			 		}
			 	}
			 }
			 if ($i == $questions->length - 1) {
			 	fwrite($jsonFile,  " \n]}"); // end question and end answer array
			 } else {
			 	fwrite($jsonFile,  " \n]},"); // end question and end answer array
			 }	 
		}	
    }

	public function delTree($dir) { 
        $files = array_diff(scandir($dir), array('.', '..')); 

        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : $this->deleteFile("$dir/$file"); 
        }

        return rmdir($dir); 
	}
   	
}
