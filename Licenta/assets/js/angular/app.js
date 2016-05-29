(function() {	
  var app = angular.module('schoolViolence',['ngRoute'])
			.config(['$routeProvider', function($routeProvider) {
				$routeProvider.
					when('/', {templateUrl: 'Licenta', controller: "header"}).
					when('/teacher', {templateUrl: 'Licenta/teacher.php', controller: "teacher"}).
					when('/login', {templateUrl: 'Licenta/login.php', controller: "login"})
			}]);

})();