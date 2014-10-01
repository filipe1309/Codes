var http = require('http');
var fs = require('fs');
var leituraAsync = require('./s_3_2_leitura_async');
var leituraSync = require('./s_3_2_leitura_sync');

var arquivo = "./node.zip";
var stream = fs. createWriteStream(arquivo);
var download = "http://nodejs.org/dist/v0.10.12/node-v0.10.12.tar.gz";

http.get(download, function(res) {
	console.log("Fazendo download do Node.js");
	res.on('data', function(data) {
		stream.write(data);
	});
	res.on('end', function() {
		stream.end();
		console.log("Download finalizado!");
		leituraAsync(arquivo);
		leituraSync(arquivo);
	});
});