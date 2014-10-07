module.exports = function(app) {
	// Controller para a página de Contato
	var ContatoController = {
		// Action do controller
		index: function(req, res) {
			var usuario = req.session.usuario,
				params = {usuario: usuario};
			res.render('contatos/index', params);
		}
	}
	return ContatoController;
};