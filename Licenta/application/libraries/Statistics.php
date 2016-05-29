<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Statistics {

	public function generateStatisticsForQuestion($questionID, $result, $numberOfAnswers) {

		$numberOfPersonsWhoAnsweredToTest = count($result);
		$answerCounterArray = array();
		for ($index = 0; $index < $numberOfAnswers; $index ++) {
			$answerCounterArray[$index] = 0;
		}
		
		for ($i = 0; $i < count($result); $i ++) {

			$logLocation = $result[$i]["location"];
			$data = file_get_contents($logLocation);
			$data = json_decode($data);
			$question = $data->questions[$questionID];
			$howManyAnswers = count($question->answers);
			$finalAnswerForQuestion = $question->answers[$howManyAnswers - 1];
			$array = (array)$finalAnswerForQuestion;
			$answerCounterArray[$array["answer-id"] - 1] ++;
		}
		
		for ($index = 0; $index < count($answerCounterArray); $index ++) {
			$answerCounterArray[$index] = ($answerCounterArray[$index] / $numberOfPersonsWhoAnsweredToTest) * 100;
		}
		return $answerCounterArray;
	}
}