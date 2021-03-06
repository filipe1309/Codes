pessoas
	.controller('PessoasCtrl', 
		['$scope','PessoasSrv','$location','$routeParams' 
			function($scope, PessoasSrv, $location, $routeParams) {
				//$scope.nome= "Filipe";
				$scope.load = function() {
					$scope.registros = PessoasSrv.query();
				};

				$scope.clear = function() {
					$scope.item = "";
				};

				$scope.get = function() {
					$scope.item = PessoasSrv.get({id: $routeParams.id})
				};

				$scope.add = function(item) {
					$scope.result = PessoasSrv.save(
						{},
						$jQuery.param(item),
						function(data, status, header, config) {
							$location.path('/');
						},
						function(data, status, header, config) {
							alert('Ocorreu um erro: '+data.messages[0]);
						}
					);
				};

				$scope.editar = function(item) {
					var params = $jQuery.param(JSON.parse(angular.toJson(item)));

					$scope.result = PessoasSrv.update(
						{id: $routeParams.id},
						params,
						function(data, status, header, config) {
							$location.path('/');
						},
						function(data, status, header, config) {
							alert('Ocorreu um erro: '+data.messages[0]);
						}
					);
				}

				$scope.delete = function(id) {
					if(confirm('Deseja realmente excluir esta pessoa?')) {
						PessoasSrv.remove(
							{id: id},
							{},
							function(data, status, header, config) {
								$scope.load();
							},
							function(data, status, header, config) {
								alert('Ocorreu um erro: '+data.messages[0]);
							}	
						)
					} else {
						$scope.load();
					}
				};
			}
		]
	);