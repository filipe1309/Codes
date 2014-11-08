angular.module('sonApp.controllers', ['sonApp.services'])
	.controller('UsersCtrl',
		['$scope','UsersSrv', 
			function($scope, UsersSrv) {
				$scope.nome = "|Var do angular - controller.js|";
				$scope.load = function() {
					
				}
			}
		]
	);