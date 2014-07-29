var http = require('http'); // Existe um http.js na pasta do npm node_modules (local, ~/, de instalção do node)

var modHello = require('./hello'); // Busca na pasta atual
modHello.hello();
modHello.world();
// Ou var modHello = require('./hello').hello();