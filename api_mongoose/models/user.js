var connection = require("./");

var mongoose = connection.mongoose
	, Schema = mongoose.Schema;

var UserSchema = new Schema({
	name: {type: String, default: ''},
	email: {type: String, default: '', unique: true},
	password: {type: String, default: ''},
});

var User = mongoose.model("User", UserSchema);

exports.list = function(req, res) {
	User
		.find()
		.exec(function(err, users) {
			if(err) {
				console.log(err);
			} else {
				res.json(users);
			}
		});
};