/* GET users listing. */

var UserModel = require("../models/user");

exports.list = function(req, res){
  //res.send('respond with a resource');
  UserModel.list(req, res);
};
