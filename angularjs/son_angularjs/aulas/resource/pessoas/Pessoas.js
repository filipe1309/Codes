var pessoas = angular.module('Pessoas', ['ngRoute','ngResource']);

pessoas
	.config(
		[
			'$routeProvider',
			function($routeProvider) {
				$routeProvider
					.when('/', {
						templateUrl: 'index.html'
					});	
			} 
		]
	);