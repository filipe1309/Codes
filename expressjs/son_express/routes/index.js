/* GET home page. */
exports.index = function(req, res){
  res.render('index', { title: 'nz-Express' });
};

exports.hello = function(req, res) {
	var data = {
		name: "Filipe Leuch Bonfim",
		site: "www.inf.ufpr.br/flb09"
	}

	res.json(data);
}
