<?php namespace Modules\Multimedia\Src\Repositories;

use App\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Modules\Multimedia\Src\Validators\MultimediaValidatorInterface;
use Modules\Multimedia\Src\Repositories\MultimediaRepositoryInterface;
use Auth;

class MultimediaRepository implements MultimediaRepositoryInterface {

	use Traits\ContainerTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Eloquent multimedia model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Constructor.
	 *
	 * @param  \Illuminate\Container\Container  $app
	 * @return void
	 */
	public function __construct(Container $app, MultimediaValidatorInterface $validator)
	{
		$this->setContainer($app);

		$this->validator = $validator;

		$this->setModel(get_class($app['Modules\Multimedia\Src\Models\Multimedia']));
	}

	/**
	 * {@inheritDoc}
	 */
	public function grid()
	{
		return $this
			->createModel();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll()
	{
			return $this->createModel()->get();
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->createModel()->find($id);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForCreation(array $input)
	{
		return $this->validator->on('create')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForUpdate(array $input)
	{
		return $this->validator->on('update')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function store($id, array $input)
	{
		return ! $id ? $this->create($input) : $this->update($id, $input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $input)
	{
		// Create a new multimedia
		$multimedia = $this->createModel();

		$input = $this->prepareData($input);
		

		// Validate the submitted data
		$messages = $this->validForCreation($input);
		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			
			$input['uploaded_by'] = \Auth::user()->id;
			// Save the multimedia
			$multimedia->fill($input)->save();

		}



		return [ $messages, $multimedia ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function createMultiple(array $data)
	{
		// Create a new multimedia
		$multimedia = $this->createModel();

		$input = $this->prepareData($input);
		

		// Validate the submitted data
		$messages = $this->validForCreation($input);
		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			
			$input['uploaded_by'] = \Auth::user()->id;
			// Save the multimedia
			$multimedia->fill($input)->save();

		}



		return [ $messages, $multimedia ];
	}


	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the multimedia object
		$multimedia = $this->find($id);

		//Prepare data
		$input = $this->prepareData($input);
		

		$this->validator->setModel($multimedia);
		// Validate the submitted data
		$messages = $this->validForUpdate($input);

		
		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the multimedia
			$multimedia->fill($input)->save();
		}

		return [ $messages, $multimedia ];
	}


	public function prepareData(array $input)
	{
		$input['url'] = isset($input['path']) ? $input['path'] : $input['url'];
		return $input;
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the multimedia exists
		if ($multimedia = $this->find($id))
		{
			// Delete the multimedia entry
			$multimedia->delete();
			return true;
		}

		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function enable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => true ]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function disable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => false ]);
	}
}
