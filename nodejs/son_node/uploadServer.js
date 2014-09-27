var http = require('http');
var fs = require('fs');

// curl --upload-file debian-7.5.0-amd64-CD-1.iso http://localhost:8882/
http.createServer( function(req, res) {
	res.writeHead(200);
	var newFile = fs.createWriteStream('newDebianCd.iso');
	var size = req.headers['content-length']; // Get length of Client file
	var uploaded = 0;
	req.pipe(newFile); // Copy file from client to Server
	req.on('data',function(chunk) {
		uploaded += chunk.length;
		var progress = (uploaded / size) * 100;
		res.write('Progress: '+parseInt(progress,10)+'%\n');
	});
	//res.end();
}).listen(8882);
