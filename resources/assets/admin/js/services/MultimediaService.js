import BaseService from 'easy-requests';

export default class Multimedia extends BaseService {

	constructor() {
		super();
		this.config.prefix = '/admin/';
		// this.config.origin = 'https://api.facebook.com';
		// this.config.endpointUrl = 'store-requests/';
	}


	grid() {
		var that = this;
		var endpoint = this.buildUrl() + "grid"
		var resource_promise = new Promise((resolve, reject) => {
			this.http.get(endpoint)
				.then((grid) => {
					console.log(grid.data)
					resolve(grid.data);
				})
				.catch((err) => {
					reject(err);
				});
		});
		return resource_promise;
	}


	createMultiple(file) {

		var myForm = new FormData();

		myForm.append('title', file.title);
		myForm.append('path', file.path);
		myForm.append('description', file.description);

		// files.forEach((file, index) => {
		// 	myForm.append('files[' + index + '][title]', file.title);
		// 	myForm.append('files[' + index + '][path]', file.path);
		// 	myForm.append('files[' + index + '][description]', file.description);
		// });

		var endpoint = this.buildUrl()
		var resource_promise = new Promise((resolve, reject) => {
			this.http.post(endpoint + "/create-multiple", myForm)
				.then((grid) => {
					resolve(grid.data); // Deberiamos definir las convenciones para cuando recibamos una collección
				})
				.catch((err) => {
					reject(err);
				});
		});
		return resource_promise;
	}

}