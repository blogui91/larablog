import BaseService from 'easy-requests';

export default class User extends BaseService {

	constructor() {
		super();
		this.service.config.prefix = '/admin/';
		// this.config.origin = 'https://api.facebook.com';
		// this.config.endpointUrl = 'store-requests/';
	}

}