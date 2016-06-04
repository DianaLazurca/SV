(function() {
	var app = angular.module("schoolViolence");
	var studentController = function($scope, $http) {
		$scope.isStarted = false;
		$scope.isFinished = false;
		$scope.SITE = "http://localhost:8080/Licenta/";
		$scope.currentQuestionId = 0;
		$scope.isLastQuestion = false;
		$scope.currentTest = [];
		$scope.currentQuestion = [];
		$scope.testLog = {};
		$scope.enabledQuestionsList = [];
		$scope.questionTime = 0;
		$scope.questionText;
		
		$scope.startTest = function() {
			$scope.testID = document.getElementById("startTest").getAttribute("data-id");
			$scope.testLog["test-id"] = $scope.testID;
     		var startTime =  new Date().getTime();
     		$scope.testLog["start-test"] = startTime;
			$scope.testLog["questions"] = {};
			$http({
				  method: 'GET',
				  url: SITE +  'Test/getTestById?id=' + $scope.testID
				}).then(function successCallback(response) {
					$scope.getTestJson(response.data);
					$scope.testLog["test-location"] = response.data.Location;
					$scope.isStarted = true;					
					
				}, function errorCallback(response) {
					console.log("[startTest] ERROR while getting the test")
			});
			
		};
		
		$scope.getTestJson = function(test) {
			$http({
				  method: 'GET',
				  url: test.Location
				}).then(function successCallback(response) {
					$scope.currentTest = response.data;
					$scope.currentQuestion = $scope.currentTest.questions[0];
					$scope.questionText = $scope.currentQuestion.question_id + ". " +  $scope.currentQuestion.text;
					$scope.enabledQuestionsList[0] = true;
					for (var i = 1; i < $scope.currentTest.questions.length; i++) {
						$scope.enabledQuestionsList[i] = false;
					}
					$scope.addQuestionToTestLog($scope.currentQuestion, 0);
					$scope.questionTime = new Date().getTime();
				}, function errorCallback(response) {
					console.log("[getTestJson] ERROR while getting the test")
			});
		};
		
		$scope.changeQuestion = function(index) {
			if ($scope.checkIfAnAnswerIsSelected() == false) {
				var alertButton = document.getElementById("alertModalButton");
				var modalText = document.getElementById("alertModalMessage");
				modalText.innerHTML = "Please select an answer.";
				alertButton.click();
			} else {	
				var finishQuestion = new Date().getTime();				
				$scope.addCompletedTimeToQuestion($scope.currentQuestionId, finishQuestion - $scope.questionTime);
				
				$scope.currentQuestionId = index;
				$scope.currentQuestion = $scope.currentTest.questions[index];
				$scope.questionText = $scope.currentQuestion.question_id + ". " +  $scope.currentQuestion.text;
				$scope.addQuestionToTestLog($scope.currentQuestion, 0);
				if (index == $scope.currentTest.questions.length - 1) {
					$scope.isLastQuestion = true;
				} else {
					$scope.isLastQuestion = false;
				}
				$scope.questionTime = new Date().getTime();
			}
			
		};
		$scope.next = function () {							
			$scope.changeQuestion($scope.currentQuestionId + 1);			
		};
		$scope.prev = function() {			
			if ($scope.currentQuestionId > 0) {
				$scope.changeQuestion($scope.currentQuestionId - 1);
			}			
		};
		$scope.finish = function() {
			var alertButton = document.getElementById("confirmModalButton");
			var modalText = document.getElementById("confirmModalMessage");
			modalText.innerHTML = "Are you sure that you want to finish the test?";
			alertButton.click();
		};
		$scope.confirmSubmission = function() {
			var finishQuestion = new Date().getTime();				
			$scope.addCompletedTimeToQuestion($scope.currentQuestionId, finishQuestion - $scope.questionTime);
			var startTime = $scope.testLog["start-test"];
			$scope.testLog["finish-time"] = new Date().getTime() - startTime;
			
			/// save log to logs folder + save it to db
			
			$.ajax({
				method : "POST",
				url : SITE + "Test/sendTestLog",
				data  : {"testAnswers" : $scope.testLog},
				complete : function (xhr, status) {
					if (status === 'error' || !xhr.responseText) {
		         	    console.log("[confirmSubmission]error while sending test log to server");
		     		} else {
		     			console.log(xhr.responseText);
		     			console.log("ce am primit de la server");
						
			      }
				}   
		    	   
			});
			
			$scope.isStarted = false;
			$scope.isFinished  = true;
			
		};
		$scope.resume = function() {			
			var alertButton = document.getElementById("resumeModalButton");
			var modalText = document.getElementById("resumeModalMessage");
			//modalText.innerHTML = "Are you sure that you want to finish the test?";
			alertButton.click();
		}
		$scope.addQuestionToTestLog = function(question, time) {
			if (!$scope.checkIfQuestionAlreadyExistsInLog(question['question_id'])) {
				var answeredQuestion = {};
				answeredQuestion["question-id"] = question["question_id"];
				answeredQuestion["answers"] = {};
				answeredQuestion["answered-time"] = 0;
				answeredQuestion["text"] = question["text"];
				$scope.testLog["questions"][$scope.currentQuestionId] = answeredQuestion;
				
			} 
		};

		$scope.addCompletedTimeToQuestion = function (questionIndex, time) {
			oldAnsweredTime= $scope.testLog["questions"][parseInt(questionIndex)]["answered-time"];	
			$scope.testLog["questions"][parseInt(questionIndex)]["answered-time"] = oldAnsweredTime +  time;
		};
		$scope.checkIfQuestionAlreadyExistsInLog = function(id) {
			var exists = false;
			if ($scope.objectLength($scope.testLog["questions"]) == 0) {
				return false;
			}

			for (var i = 0; i < $scope.objectLength($scope.testLog["questions"]); i++) {
				if ($scope.testLog["questions"][i]["question-id"] == id) {
					exists = true;
				}
			}

			return exists;
		};
	
		$scope.pickAnswer = function (answerID) {
			if ($scope.currentQuestionId != $scope.currentTest.questions.length - 1) {
				$scope.enabledQuestionsList[$scope.currentQuestionId + 1] = true;
			}
			var chosenAnswer = {};
			if ($scope.currentQuestion.answers[answerID].isImage == true) {
				chosenAnswer = {"answer-id" : answerID + 1, "text" : "", "img" : $scope.currentQuestion.answers[answerID].image};
			} else {
				chosenAnswer = {"answer-id" : answerID + 1, "text" : $scope.currentQuestion.answers[answerID].text, "img" : ""};
			}
			var answersLength = $scope.objectLength($scope.testLog["questions"][$scope.currentQuestionId]["answers"]);
			$scope.testLog["questions"][$scope.currentQuestionId]["answers"][answersLength] = chosenAnswer;
		};
		$scope.checkIfAnAnswerIsSelected = function() {
			var radios = document.getElementsByName("answers");
			for( i = 0; i < radios.length; i++ ) {
				if( radios[i].checked ) {
					return true;
				}
			}
			return false;
		};
		$scope.objectLength = function(objectToCOuntElements) {
			var i = 0;
			for ( var p in objectToCOuntElements ) 
					i++;
			return i;
		};
		
	}
	
	app.controller('student', studentController, ['$scope', '$http']);
})();