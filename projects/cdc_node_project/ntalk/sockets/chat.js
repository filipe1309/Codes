module.exports = function (io) {
	var sockets = io.sockets;
	sockets.on('connection', function (client) {
		var session = client.handshake.session,
			usuario = session.usuario;
		client.on('send-server', function (msg) {
			var msg = "<br>" + usuario.nome + ":<br> " + msg + "<br>";
			// Envia mensagens para o cliente ou servidor
			client.emit('send-client', msg);
			// Envia mensagens para todos os clientes, 
			// exceto o próprio emissor
			client.broadcast.emit('send-client', msg); 
		});
	});
};