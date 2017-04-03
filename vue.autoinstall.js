let glob = require("glob")
let fs = require('fs');

let baseJSPath = "resources/assets/";

let paths = {
	frontend: {
		basePath: baseJSPath + "frontend/js/components/**/*.vue",
		filename: baseJSPath + "frontend/js/components.manifest.js"
	},
	admin: {
		basePath: baseJSPath + "admin/js/components/**/*.vue",
		filename: baseJSPath + "admin/js/components.manifest.js"
	}
}

let VueAutoInstall = {

	getName(path) {
		let splited_path = path.split('/');
		let n = splited_path[splited_path.length - 1];
		let name = n.split('.')[0];
		return name;
	},
	createFile(n) {
		var self = this;
		let namespace = paths[n];

		// options is optional 
		glob(namespace.basePath, function(er, files) {
			let docs = [];

			let path;
			files.forEach(function(file) {
				let new_file = {};

				new_file.name = self.getName(file);
				new_file.path = "./" + file.split('js/')[1];

				docs.push(new_file);
			});

			let string_file = self.createContent(docs);
			fs.writeFile("./" + namespace.filename, string_file, function(err) {
				if (err) {
					console.log("there was an error saving files ", err);
				} else {
					console.log("Creating paths for each component...")
					console.log(namespace.filename + " has been generated")
				}
			});
		})
	},
	createContent(body) {
		return "//DO NOT UPDATE THIS FILE \n // This file is AUTOGENERATED \n\n export default" + JSON.stringify(body);
	}
}

Object.keys(paths)
	.forEach(path => {
		console.log(path)
		VueAutoInstall.createFile(path);
	});