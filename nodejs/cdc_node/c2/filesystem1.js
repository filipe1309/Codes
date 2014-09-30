var fs = require('fs');

// fs read file Assíncrono
fs.readFile('./index.html', function(erro, arquivo) {
	if(erro) throw erro;
	console.log('Assincrono: '+arquivo);
});

// fs read file Síncrono
var arquivo = fs.readFileSync('./index.html');
console.log('Sincrono: '+arquivo);