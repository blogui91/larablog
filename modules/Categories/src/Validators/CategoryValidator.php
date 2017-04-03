<?php namespace Modules\Categories\Src\Validators;

use Modules\Helpers\CustomValidator as Validator;

class CategoryValidator extends Validator implements CategoryValidatorInterface {

	protected $rules = [
		'name' => 'required',
	];

	protected $messages = [
		'slug.unique' => 'Este slug ya está en uso'
	];

	public $model = null;

	/**
	 * {@inheritDoc}
	 */
	public function onUpdate()
	{
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
