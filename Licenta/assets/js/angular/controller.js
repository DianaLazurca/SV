(function() {
	var app = angular.module("schoolViolence", []);
	var controller =  function($scope) {
		$scope.name = "Gigel";
		$scope.collapse = function(element) {
			$('.collapse[id="navbar"]').collapse('toggle');			
		}
	};
	
	
	
	var controllerTeacher =  function($scope) {
		$scope.name = "Gigel";
		$scope.collapse = function() {
			$('.collapse[id="answers"]').collapse('toggle');
		}
	};
	
	app.controller('header', controller, ['$scope']);
	app.controller('teacher', controllerTeacher, ['$scope']);
})();
