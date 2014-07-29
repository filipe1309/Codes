var EventEmt = require('events').EventEmitter;

var logger = new EventEmt();
logger.on('error',function(message) {
	console.log('Erro: '+message);
});

logger.on('aviso',function(message) {
	console.log('Aviso: '+message);
});

logger.on('info',function(message) {
	console.log('Info: '+message);
});

logger.emit('error','Olá meu erro!');
logger.emit('aviso','Olá meu aviso!');
logger.emit('info','Olá meu info!');
