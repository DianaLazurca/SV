(function() {
	var app = angular.module("schoolViolence");
	var teacherController =  function($scope, $http) {
		$scope.name = "Gigel";
		$scope.SITE = "http://localhost:8080/Licenta/";
		$scope.allTests = [];
		$scope.currentTest = [];
		$scope.itemsPerPage = 1;
		$scope.currentPage = 0;
		$scope.currentTestId;
		$scope.pagedItems = [];
		$scope.collapse = function() {
			$('.collapse[id="answers"]').collapse('toggle');
			console.log("collapse");			
		};
		$scope.init = function(){
			$http.get($scope.SITE + "Test/getAllTests")
				.then(function(response) {
					$scope.allTests = response.data;					
					$scope.currentTestId = 0;
					$scope.currentPage = 0;
					$scope.getTestJson($scope.allTests[0]);
					
				});
		};
		$scope.getTestJson = function(test) {
			
			$http.get(test.Location)
				.then(function(response) {
					$scope.currentTest = response.data;
					$scope.groupToPages();
				});
		};
		$scope.changeTest = function(index) {
			//console.log(index);
			$scope.currentTestId = index;
			$scope.currentPage = 0;
			$scope.getTestJson($scope.allTests[index]);
			//$scope.groupToPages();
		};
		$scope.groupToPages = function () {
			$scope.pagedItems = [];
			console.log($scope.currentTest);
			for (var i = 0; i < $scope.currentTest["questions"].length; i++) {
				if (i % $scope.itemsPerPage === 0) {
					$scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.currentTest.questions[i] ];
				} else {
					$scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.currentTest.questions[i]);
				}
			}
		};
		$scope.prevPage = function () {
			if ($scope.currentPage > 0) {
				$scope.currentPage--;
			}
		};
		
		$scope.nextPage = function () {
			if ($scope.currentPage < $scope.pagedItems.length - 1) {
				$scope.currentPage++;
			}
		};
		
		$scope.setPage = function () {
			$scope.currentPage = this.n;
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
	};
	
	app.controller('teacher', teacherController, ['$scope', '$http']);
})();
