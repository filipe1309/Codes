var express = require('express'),
// Requires através da função load
	load = require('express-load'),
	app = express(),
	error = require('./middleware/error'),
	server = require('http').createServer(app),
	io = require('socket.io').listen(server);
//var routes = require('./routes');

// view engine setup
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

// Arquivos de sessão através de cookies =)
app.use(express.cookieParser('ntalk'));
app.use(express.session());

// Cria objetos JSON vindos de um formulário html
// através dos atributos name e value, nas tags
// input, select e textarea
app.use(express.bodyParser());

// Permite utilizar o mesmo path entre os métodos
// http, fazendo uma sobrescrita de métodos
app.use(express.methodOverride());

// middleware, que gerencia as rotas da aplicação,
// permitindo a implementação de rotas para
// páginas de erros e para arquivos estáticos,
// sem conflitar com as rotas da aplicação
app.use(app.router);

app.use(express.static(__dirname + '/public'));
app.use(error.notFound);
app.use(error.serverError);
//app.get('/', routes.home);
//app.get('/usuarios', routes.user.index);

load('models')
    .then('controllers')
    .then('routes')
    .into(app);

io.sockets.on('connection', function (client) {
	client.on('send-server', function (data) {
		var msg = "<br>" + data.nome + ":<br> " + data.msg + "<br>";
		// Envia mensagens para o cliente ou servidor
		client.emit('send-client', msg);
		// Envia mensagens para todos os clientes, 
		// exceto o próprio emissor
		client.broadcast.emit('send-client', msg); 
	});
});

server.listen(3000, function() {
    console.log("Ntalk no ar.");	
});
// app.listen(3000, function() {
//     console.log("Ntalk no ar.");
// });
