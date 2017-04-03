<?php namespace Modules\Tags\Src\Repositories;

use App\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Modules\Tags\Src\Validators\TagValidatorInterface;
use Modules\Tags\Src\Repositories\TagRepositoryInterface;
use Auth;

use Modules\Tags\Src\Events\NewTagRequest;
use Modules\Tags\Src\Events\UpdatedTagRequest;


class TagRepository implements TagRepositoryInterface {

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
	public function __construct(Container $app, TagValidatorInterface $validator)
	{
		$this->setContainer($app);

		$this->validator = $validator;

		$this->setModel(get_class($app['Modules\Tags\Src\Models\Tag']));
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
		$tag = $this->createModel();

		$input = $this->prepareData($input);

		// Validate the submitted data
		$messages = $this->validForCreation($input);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the role
			$tag->fill($input)->save();

			//Dispatch event of created resource
			event(new NewTagRequest($tag));
		}



		return [ $messages, $tag ];
	}


	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the role object
		$tag = $this->find($id);

		//Prepare data
		$input = $this->prepareData($input);
		

		$this->validator->setModel($tag);
		// Validate the submitted data
		$messages = $this->validForUpdate($input);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the role
			$tag->fill($input)->save();
		}

		//Dispatch event of updated resource
		event(new UpdatedTagRequest($tag));

		return [ $messages, $tag ];
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
		if ($tag = $this->find($id))
		{
			// Delete the role entry
			$tag->delete();
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
