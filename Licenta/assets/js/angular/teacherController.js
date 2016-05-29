(function() {
	var app = angular.module("schoolViolence");
	var controller =  function($scope) {
		$scope.name = "Gigel";
		$scope.collapse = function() {
			$('.collapse').collapse('toggle');
			console.log("collapse");			
		}
	};
	
	app.controller('teacher', controller);
})();
