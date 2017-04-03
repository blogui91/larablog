<?php namespace Modules\Multimedia\Src\Validators;

use Modules\Helpers\CustomValidator as Validator;

class MultimediaValidator extends Validator implements MultimediaValidatorInterface {

	protected $rules = [
		'title' => 'required',
 	];

	protected $messages = [
		'title.unique' => 'Este titulo ya existe'
	];

	public $model = null;

	/**
	 * {@inheritDoc}
	 */
	public function onUpdate()
	{
		$this->rules = [
			'title' => 'required|unique:multimedias,title'.$this->getModelId(),  //We are validating 
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
