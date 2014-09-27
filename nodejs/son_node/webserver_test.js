var http = require('http');

/* Creat Server */
// http.createServer( function(request, response) {
// 	response.writeHead(200);
// 	response.write('Hello World\n');
// 	response.end();
// }).listen(8880);

/* Creat Server - Another way */
// var server = http.createServer();
// server.on('request',function(req, res) {
// 	res.writeHead(200);
// 	res.end('Hello World 2\n');		
// });
// server.listen(8882);
// console.log("Starting server...");

/* setTimeout */
// var server = http.createServer();
// server.on('request',function(req, res) {
// 	res.writeHead(200);
// 	res.write('Servidor mandou 1º pacote...\n')
// 	setTimeout(function(){
// 		res.end('Servidor mandou 2º pacote \n');		
// 	}, 5000);
// });
// server.listen(8882);
// console.log("Starting server...");

/* Pipe */
// curl -d 'Ola' http://localhost:8882/
var server = http.createServer();
server.on('request',function(req, res) {
	res.writeHead(200);
	
	/* Pipe v2 */
	req.pipe(res);

	/* Pipe v1 */
	// req.on('data', function(chunk) {
	// 	//console.log(chunk.toString());
	// 	res.write(chunk);
	// });

	// req.on('end', function(chunk) {
	// 	res.end('   acabou\n');
	// });		
});
server.listen(8882);
console.log("Starting server...");

