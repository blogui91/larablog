<?php namespace Modules\Categories\Src\Repositories;

use App\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Modules\Categories\Src\Validators\CategoryValidatorInterface;
use Modules\Categories\Src\Repositories\CategoryRepositoryInterface;
use Auth;

use Modules\Categories\Src\Events\NewCategoryRequest;
use Modules\Categories\Src\Events\UpdatedCategoryRequest;


class CategoryRepository implements CategoryRepositoryInterface {

	use Traits\ContainerTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Eloquent role model.
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
	public function __construct(Container $app, CategoryValidatorInterface $validator)
	{
		$this->setContainer($app);

		$this->validator = $validator;

		$this->setModel(get_class($app['Modules\Categories\Src\Models\Category']));
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
		// Create a new role
		$category = $this->createModel();

		$input = $this->prepareData($input);

		// Validate the submitted data
		$messages = $this->validForCreation($input);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the role
			$category->fill($input)->save();

			//Dispatch event of created resource
			event(new NewCategoryRequest($category));
		}



		return [ $messages, $category ];
	}


	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the role object
		$category = $this->find($id);

		//Prepare data
		$input = $this->prepareData($input);
		

		$this->validator->setModel($category);
		// Validate the submitted data
		$messages = $this->validForUpdate($input);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the role
			$category->fill($input)->save();
		}

		//Dispatch event of updated resource
		event(new UpdatedCategoryRequest($category));

		return [ $messages, $category ];
	}


	public function prepareData(array $input)
	{
		return $input;
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the role exists
		if ($category = $this->find($id))
		{
			// Delete the role entry
			$category->delete();
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
