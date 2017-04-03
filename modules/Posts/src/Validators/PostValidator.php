<?php namespace Modules\Posts\Src\Validators;

use Modules\Helpers\CustomValidator as Validator;

class PostValidator extends Validator implements PostValidatorInterface {

	protected $rules = [
		'title' => 'required',
		'description' => 'required',
		'category_id' => 'required'
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
			'title' => 'required|unique:posts,title'.$this->getModelId(),  //We are validating 
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
