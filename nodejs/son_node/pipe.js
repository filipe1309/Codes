var fs = require('fs');

var file = fs.createReadStream('teste.html');
var newFile = fs.createWriteStream('teste_novo.html');

file.pipe(newFile);
