(function() {
	var app = angular.module("schoolViolence");
	var studentController = function($scope, $http) {
		$scope.isStarted = false;
		$scope.SITE = "http://localhost:8080/Licenta/";
		$scope.currentQuestionId = 0;
		$scope.isLastQuestion = false;
		$scope.currentTest = [];
		$scope.currentQuestion = [];
		$scope.testLog = [];
		
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
					
					console.log($scope.currentQuestion);
				}, function errorCallback(response) {
					console.log("[getTestJson] ERROR while getting the test")
			});
		};
		
		$scope.changeQuestion = function(index) {
			$scope.currentQuestionId = index;
			$scope.currentQuestion = $scope.currentTest.questions[index];
			if (index == $scope.currentTest.questions.length - 1) {
				$scope.isLastQuestion = true;
			} else {
				$scope.isLastQuestion = false;
			}
		};
		$scope.next = function() {
			$scope.changeQuestion($scope.currentQuestionId + 1);
		};
		$scope.prev = function() {
			
			if ($scope.currentQuestionId > 0) {
				$scope.changeQuestion($scope.currentQuestionId - 1);
			}
			
		};
		$scope.addQuestionToTestLog = function(question, time) {
			if (!checkIfQuestionAlreadyExistsInLog(question['question_id'])) {
				var answeredQuestion = {};
				
			} else {
				
			}
		};
		$scope.checkIfQuestionAlreadyExistsInLog = function(id) {
			var exists = false;
			if ($scope.testLog["questions"].length == 0) {
				return false;
			}

			for (var i = 0; i < $scope.testLog["questions"].length; i++) {
				if (testLog["questions"][i]["question-id"] == id) {
					exists = true;
				}
			}

			return exists;
		};
		
	}
	
	app.controller('student', studentController, ['$scope', '$http']);
})();