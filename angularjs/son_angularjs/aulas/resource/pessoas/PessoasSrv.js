pessoas
	.factory('PessoasSrv', function($resource) {
		return $resource(
			'http://filipe1309.kd.io/cursos/Codes/nodejs/modulos/package.json'
			//'/index.html/pessoas'
			//'/home/filipe1309/devel/mean/Codes/angularjs/son_angularjs/aulas/resource/pessoas/templates/package.json'
		);
	});