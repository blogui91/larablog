<?php namespace Modules\Roles\Src\Repositories;

use App\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Modules\Roles\Src\Validators\RoleValidatorInterface;
use Modules\Roles\Src\Repositories\RoleRepositoryInterface;
use Auth;

use Modules\Roles\Src\Events\NewRoleRequest;
use Modules\Roles\Src\Events\UpdatedRoleRequest;


class RoleRepository implements RoleRepositoryInterface {

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
	public function __construct(Container $app, RoleValidatorInterface $validator)
	{
		$this->setContainer($app);

		$this->validator = $validator;

		$this->setModel(get_class($app['Modules\Roles\Src\Models\Role']));
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
		$role = $this->createModel();

		$input = $this->prepareData($input);

		// Validate the submitted data
		$messages = $this->validForCreation($input);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the role
			$role->fill($input)->save();

			//Dispatch event of created resource
			event(new NewRoleRequest($role));
		}



		return [ $messages, $role ];
	}


	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the role object
		$role = $this->find($id);

		//Prepare data
		$input = $this->prepareData($input);
		

		$this->validator->setModel($role);
		// Validate the submitted data
		$messages = $this->validForUpdate($input);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the role
			$role->fill($input)->save();
		}

		//Dispatch event of updated resource
		event(new UpdatedRoleRequest($role));

		return [ $messages, $role ];
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
		if ($role = $this->find($id))
		{
			// Delete the role entry
			$role->delete();
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
