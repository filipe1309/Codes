var http = require('http');
var url = require('url');

// INPUT: http://localhost:3000/?query=texto
// OUTPUT: a variavel passada por GET e seu valor, 
// no caso var: query e valor: texto.

var server = http.createServer(function(request, response) {
	response.writeHead(200, {"Content-Type":"text/html"});
	response.write("<h1>Dados da query string</h1>");

	var result = url.parse(request.url, true);
	for(var key in result.query){
		response.write("<h2>"+key+" : "+result.query[key]+"</h2>");
	}

	// Para imprimir todo o Objeto da url do request
	// var result = url.parse(request.url, true);
	// for(var key in result){
	// 	response.write("<h2>"+key+" : "+result[key]+"</h2>");
	// }

	//response.write("<h2>"+result+"</h2>");

	console.log(result);
	response.end();
});

server.listen(3000, function() {
	console.log('Servidor http.');
});