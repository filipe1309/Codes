fs = require('fs');
console.log('Iniciando...');
fs.readFile('teste.html','utf8',function(err, data) {
	console.log(data);
});
console.log('Finalizado');