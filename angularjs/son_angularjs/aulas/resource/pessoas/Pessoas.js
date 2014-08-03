var pessoas = angular.module('Pessoas', ['ngRoute','ngResource']);

pessoas
	.config(
		[
			'$routeProvider',
			function($routeProvider) {
				$routeProvider
					.when('/', {
						templateUrl: 'index.html'
					})	
					.when('/novo', {
						templateUrl: 'novo.html'
					})
					.when('/editar/:id', {
						templateUrl: 'editar.html'
					});
			} 
		]
	);