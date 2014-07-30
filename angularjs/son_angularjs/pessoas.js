angular
	.module('pessoas',['ngRoute'])
	.config(function($routeProvider) {
		$routeProvider
		.when('/', {
			templateUrl: 'listar.html'
			//,controller:'CtrlPessoas'
			}).when('/pessoa/adicionar', {
				templateUrl: 'adicionar.html',
				controller: 'CtrlAdicionar'
			}).when('/pessoa/:index', {
				templateUrl: 'editar.html',
				controller: 'CtrlEditar'
			}).when('/pessoa/remover/:index', {
				templateUrl: 'listar.html',
				controller: 'CtrlRemover'
			});
	})
	.controller('CtrlPessoas',function($scope) {
		$scope.pessoas=[
			{nome:"Filipe", cidade:"Curitiba"},
			{nome:"Bob", cidade:"São Paulo"},
			{nome:"Ignar", cidade:"Butiatuvinha"},
			{nome:"Dubox", cidade:"Arararar"}
		];
	}).controller('CtrlAdicionar', function($scope) {
		
		$scope.add = function() {
			/*$scope.pessoas.push({
				nome : $scope.pessoa.nome,
				cidade : $scope.pessoa.cidade			
			});*/
			$scope.pessoas.push($scope.pessoa);

			//$scope.pessoa.nome = "";		
			//$scope.pessoa.cidade = "";
			$scope.pessoa = "";		

			$scope.result = "Registro adicionado com sucesso!!!";
		}
	}).controller('CtrlEditar', function($scope, $routeParams) {
		$scope.pessoa = $scope.pessoas[$routeParams.index];
	}).controller('CtrlRemover', function($scope, $routeParams) {
		$scope.pessoas.splice($routeParams.index,1);
	});