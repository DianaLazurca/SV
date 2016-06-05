(function() {
	var app = angular.module("schoolViolence");
	var teacherController =  function($scope, $http) {
		$scope.name = "Gigel";
		$scope.SITE = "http://localhost:8080/Licenta/";
		$scope.allTests = [];
		$scope.currentTest = [];
		$scope.itemsPerPage = 1;
		$scope.currentPage = 0;
		$scope.currentPageEval = 0;		
		$scope.currentPageLogEval = 0;
		$scope.currentTestId;
		$scope.pagedItems = [];
		$scope.isQuestionTab = true;
		$scope.isEvaluationTab = false;
		$scope.evaluationArray = [];
		$scope.evalsPerPage = 10;
		$scope.logEvalsPerPage = 1;
		$scope.pagedEvals = [];
		$scope.pagedLogEvals = [];
		$scope.currentLogToBeEvaluated = {};
		$scope.currentLogToBeEvaluatedJSON = {};
		$scope.isTransfInInput = false;
		$scope.evaluation = "";
		
		$scope.collapse = function() {
			$('.collapse[id="answers"]').collapse('toggle');
			console.log("collapse");			
		};
		$scope.init = function() {
			$http({
				  method: 'GET',
				  url: SITE +  'Test/getAllTests?id=' + $scope.testID
				}).then(function successCallback(response) {
					$scope.allTests = response.data;					
					$scope.currentTestId = 0;
					$scope.currentPage = 0;
					$scope.getTestJson($scope.allTests[0]);				
					
				}, function errorCallback(response) {
					console.log("[init] ERROR while getting all tests");
			});
		};
		$scope.getTestJson = function(test) {
			
			$http.get(test.Location)
				.then(function(response) {
					$scope.currentTest = response.data;
					$scope.groupToPages();
					if ($scope.isEvaluationTab == true) {
						$scope.getEvals();
					}
			});
		};
		$scope.changeTest = function(index) {
			$scope.currentTestId = index;
			$scope.currentPage = 0;
			$scope.getTestJson($scope.allTests[index]);

			//console.log($scope.currentTest);
		};
		$scope.groupToPages = function () {
			$scope.pagedItems = [];
			for (var i = 0; i < $scope.currentTest["questions"].length; i++) {
				if (i % $scope.itemsPerPage === 0) {
					$scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.currentTest.questions[i] ];
				} else {
					$scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.currentTest.questions[i]);
				}
			}
		};
		$scope.groupEvalsToPages = function () {
			$scope.pagedEvals = [];
			for (var i = 0; i < $scope.evaluationArray.length; i++) {
				if (i % $scope.evalsPerPage === 0) {
					$scope.pagedEvals[Math.floor(i / $scope.evalsPerPage)] = [ $scope.evaluationArray[i] ];
				} else {
					$scope.pagedEvals[Math.floor(i / $scope.evalsPerPage)].push($scope.evaluationArray[i]);
				}
			}
		};
		$scope.groupLogEvalsToPages = function () {
			$scope.pagedLogEvals = [];
			for (var i = 0; i < $scope.currentLogToBeEvaluatedJSON.questions.length; i++) {
				if (i % $scope.logEvalsPerPage === 0) {
					$scope.pagedLogEvals[Math.floor(i / $scope.logEvalsPerPage)] = [ $scope.currentLogToBeEvaluatedJSON.questions[i] ];
				} else {
					$scope.pagedLogEvals[Math.floor(i / $scope.logEvalsPerPage)].push($scope.currentLogToBeEvaluatedJSON.questions[i]);
				}
			}
		};
		$scope.changeTab = function(tabIndex) {
			if (tabIndex == 1) {
				$scope.isQuestionTab = true;
				$scope.isEvaluationTab = false;
			} else {
				if (tabIndex == 2) {
					$scope.isQuestionTab = false;
					$scope.isEvaluationTab = true;
				}
			}
		};
		$scope.prevPage = function () {
			if ($scope.currentPage > 0) {
				$scope.currentPage--;
			}
		};
		
		$scope.prevPageEval = function () {
			if ($scope.currentPageEval > 0) {
				$scope.currentPageEval--;
			}
		};
		$scope.prevPageLogEval = function () {
			if ($scope.currentPageLogEval > 0) {
				$scope.currentPageLogEval--;
			}
		};
		
		$scope.nextPage = function () {
			if ($scope.currentPage < $scope.pagedEvals.length - 1) {
				$scope.currentPage++;
			}
		};
		$scope.nextPageEval = function () {
			if ($scope.currentPageEval < $scope.pagedEvals.length - 1) {
				$scope.currentPageEval++;
			}
		};
		
		$scope.nextPageLogEval = function () {
			if ($scope.currentPageLogEval < $scope.pagedLogEvals.length - 1) {
				$scope.currentPageLogEval++;
			}
		};
		
		$scope.setPage = function () {
			$scope.currentPage = this.n;
		};
		$scope.setPageEval = function () {
			$scope.currentPageEval = this.n;
		};
		$scope.setPageLogEval = function () {
			$scope.currentPageLogEval = this.n;
		};
		$scope.range = function (start, end) {
			var ret = [];
			if (!end) {
				end = start;
				start = 0;
			}
			for (var i = start; i < end; i++) {
				ret.push(i);
			}
			return ret;
		};
		
		$scope.getEvals = function() {
			
			$http({
				  method: 'GET',
				  url: SITE +  'Test/getDataEvaluationTabByTestID?id=' + $scope.currentTest['test_id']
				}).then(function successCallback(response) {					
					$scope.evaluationArray = response.data;
					$scope.groupEvalsToPages();
				}, function errorCallback(response) {
					console.log("[getEvals] ERROR while getting the evaluations");
			});
		};
		$scope.evaluateStudent = function(logIndex) {
			
			$scope.currentLogToBeEvaluated = $scope.evaluationArray[logIndex];
			console.log("evaluateStudent");
			console.log($scope.currentLogToBeEvaluated);
			$scope.evaluation = $scope.currentLogToBeEvaluated['eval_man'];
			$http({
				  method: 'GET',
				  url: $scope.currentLogToBeEvaluated.location
				}).then(function successCallback(response) {
					$scope.currentLogToBeEvaluatedJSON = response.data;
					$scope.groupLogEvalsToPages();
					var alertButton = document.getElementById("evaluateModalButton");
					alertButton.click();
					
				}, function errorCallback(response) {
					console.log("[evaluateStudent] ERROR while getting the content of log file");
			});
			
		};
		$scope.time = function(milliseconds) {
			var time = "";
			var minutes = 0;
			var hours = 0;
			var seconds = Math.floor(milliseconds / 1000);
			if (seconds > 60) {
				minutes = Math.floor(seconds / 60);
				seconds = seconds - minutes * 60;
				if (minutes > 60) {
					hours = Math.floor(seconds / 60);
					minutes = minutes - hours * 60;
				}
			}
			if (hours !== 0) {
				time = hours + "h ";
			}
			if (minutes !== 0) {
				time += minutes + "m ";
			}
			if (seconds !== 0) {
				time += seconds + "s";
			}
			return time;
		};
		$scope.fromTextToInput = function () {
			$scope.isTransfInInput = true;
		};
		
		$scope.saveClassification = function() {
			var log_id = $scope.currentLogToBeEvaluated['id'];
			var classif = "";
			if ($scope.isTransfInInput === true) {
				classif = document.getElementById('manClassifInput').value;
			} else {
				classif = $scope.currentLogToBeEvaluated['eval_man'];
			}
				
			var newDate = new Date();
			var manClassif = {};
			if (classif !== '-') {
				manClassif = {'date' : newDate, 'evaluation' : classif};
			} else {
				manClassif = {'date' : newDate, 'evaluation' : ""};
			}
			var postData = {'log_id' : log_id, 'man' : manClassif};
			
			$.ajax({
				method : "POST",
				url : SITE + "teacher/saveClassification",
				data  : {"data" : postData},
				complete : function (xhr, status) {
					if (status === 'error' || !xhr.responseText) {
		         	    console.log("[confirmSubmission]error while sending test log to server");
		     		} else {
						console.log("saveClassification");
						console.log($scope.currentLogToBeEvaluated);
						
						$scope.currentLogToBeEvaluated['eval_man'] = classif;	
						$scope.currentLogToBeEvaluated['eval_date'] = xhr.responseText;
						for (var i = 0; i < $scope.pagedEvals.length; i ++) {
							for (var j = 0; j < $scope.pagedEvals[i].length; j++) {
								if ($scope.pagedEvals[i]['id'] = $scope.currentLogToBeEvaluated['id']) {
									$scope.pagedEvals[i]['eval_man'] = classif;
									$scope.pagedEvals[i]['eval_date'] = xhr.responseText;
								}
							}
						}
						document.getElementById('manEval' + log_id).innerHTML = classif;
						if ($scope.isTransfInInput === true) {			
							
							$scope.isTransfInInput = false;
						}
					}
				} 		    	   
			});
		};
	};
	
	
	app.controller('teacher', teacherController, ['$scope', '$http']);
})();
