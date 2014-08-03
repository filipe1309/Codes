pessoas
	.controller('PessoasCtrl', 
		['$scope','PessoasSrv', 
			function($scope, PessoasSrv) {
				//$scope.nome= "Filipe";
				$scope.load = function() {
					$scope.registros = PessoasSrv.query();
				};
			}
		]
	);