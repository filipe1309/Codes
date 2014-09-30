var http = require('http');
var url = require('url');
var fs = require('fs');

var server = http.createServer(function(request, response) {
	response.writeHead(200, {'Content-Type':'text/html'});
	if(request.url == '/artigos' || request.url == '/') {
		fs.readFile(__dirname + '/artigos.html', function(err, html) {
			response.end(html);
		});
	} else if(request.url == '/contato') {
		fs.readFile(__dirname + '/contato.html', function(err, html) {
			response.end(html);
		});
	} else {
		fs.readFile(__dirname + '/erro.html', function(err, html) {
			response.end(html);
		});
	}
});

server.listen(3000, function() {
	console.log("Executando Desafio");
});