<?php namespace Modules\Users\Src\Validators;

use Modules\Helpers\CustomValidator as Validator;

class UserValidator extends Validator implements UserValidatorInterface {

	protected $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required|email|unique:users',
		'password' => 'required|min:6|confirmed',
	];

	protected $messages = [
		'email.unique' => 'Este correo electrónico ya está en uso'
	];

	/**
	 * {@inheritDoc}
	 */
	public function onUpdate()
	{
		$this->rules = [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users|sometimes',
			'password' => 'required|confirmed|min:6|sometimes'
		];
	}

}
