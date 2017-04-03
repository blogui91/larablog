<?php namespace Modules\Roles\Src\Validators;

use Modules\Helpers\CustomValidator as Validator;

class RoleValidator extends Validator implements RoleValidatorInterface {

	protected $rules = [
		'name' => 'required',
		'slug' => 'required|unique:roles',
	];

	protected $messages = [
		'email.unique' => 'Este slug ya está en uso'
	];

	public $model = null;

	/**
	 * {@inheritDoc}
	 */
	public function onUpdate()
	{
		$this->rules = [
			'name' => 'required',
			'slug' => 'required|unique:roles,slug'.$this->getModelId(),  //We are validating 
		];
	}

	public function getModelId()
	{
		return is_null($this->model)? '' : ','.$this->model->id;
	}

	public function setModel($model)
	{
		$this->model = $model;
	}



}
