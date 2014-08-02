pessoas
	.factory('PessoasSrv', function($resource) {
		return $resource(
			'/index.html/pessoas'
		);
	});