angular.module('sonApp', ['ngRoute','sonApp.controllers']) // Nome, Dependencias
	.config(
		['$routeProvider','$locationProvider',
			function($routeProvider, $locationProvider) {
				$routeProvider.when("/", {
						templateUrl: '/angular/users/teste'
					});
				$locationProvider.html5Mode(true); // Remove # da url
			}
		]
	);