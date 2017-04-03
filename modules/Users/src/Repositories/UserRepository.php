<?php namespace Modules\Users\Src\Repositories;

use App\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Modules\Users\Src\Validators\UserValidatorInterface;
use Modules\Users\Src\Repositories\UserRepositoryInterface;
use Auth;

use Modules\Users\Src\Events\NewUserRequest;
use Modules\Users\Src\Events\UpdatedUserRequest;


class UserRepository implements UserRepositoryInterface {

	use Traits\ContainerTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Eloquent users model.
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
	public function __construct(Container $app, UserValidatorInterface $validator)
	{
		$this->setContainer($app);

		$this->validator = $validator;

		$this->setModel(get_class($app['Modules\Users\Src\Models\User']));
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
		
		$roles = $this->assignRoles($input);

		// Create a new users
		$user = $this->createModel();

		if(!isset($input['activated'])){
			$input['activated'] = 0;
		}

		$created_by_admin = false;
		$pw_temp = 'secret';

		if($currentUser = Auth::user()){
			if(($currentUser->hasRole('admin'))){
				$input['activated'] = true;
				$pw_temp = str_random(10);

				$input['password'] = bcrypt($pw_temp);
				$input['password_confirmation'] = $input['password'];
				$created_by_admin = true;
			}
		}

		\Log::info(Auth::user());

		// Validate the submitted data
		$messages = $this->validForCreation($input);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the user
			$user->fill($input)->save();
			$user->syncRoles($roles);

			if($user->created_by_admin = $created_by_admin){
				$user->pw_temp = $pw_temp;
			}

			//Dispatch event of created resource
			event(new NewUserRequest($user,['created_by_admin' => $created_by_admin, 'pw_temp' => $pw_temp]));
		}



		return [ $messages, $user ];
	}


	public function assignRoles(array $input)
	{
		$currentUser = Auth::user();
		$roles = [];

		if($currentUser){
			if($currentUser->hasRole('admin')){

				if(isset($input['roles'])){
					if(count($input['roles']) > 0){
						return  $input['roles'];
					}
				}
			}
		}

		$roles = [2];
		return $roles; //Registered User
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the user object
		$user = $this->find($id);

		$prepared_data = $this->prepareData($user,$input);
		$email_hasChanged = $prepared_data['email_hasChanged'];
		$input = $prepared_data['input'];
		
		// Validate the submitted data
		$messages = $this->validForUpdate($input);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the user
			$user->fill($input)->save();

			if(isset($input['roles'])){
				$user->syncRoles($input['roles']);
			}
		}

		//Dispatch event of updated resource
		event(new UpdatedUserRequest($user,['email_hasChanged' => $email_hasChanged]));

		return [ $messages, $user ];
	}


	public function prepareData($user, array $input)
	{
		$email_hasChanged = false;
		if(isset($input['email'])){
			if($user->email != $input['email']){
				$email_hasChanged = true; // We must throw an email to confirm the new email.
			}else{
				unset($input['email']);  // We dont need to update it because it was not changed, so we avoid 'email has been taken' validation error
			}
		}else{
			$input['email'] = null;
			unset($input['email']);
		}

		if($user->activated == 1 && $input['activated'] == 0){
			$input['activated'] = 1;
		}

		$input['password'] = null; // It's not safe saving the password , we prefer create another method exclusively to update it
		unset($input['password']);

		if(isset($input['roles'])){
			$roles = $input['roles'];
			if(is_array($roles)){
				if(count($roles) == 0){
					unset($input['roles']);
				}
			}else{
				unset($input['roles']);
			}
		}

		return ['email_hasChanged' => $email_hasChanged, 'input' => $input];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the users exists
		if ($users = $this->find($id))
		{
			// Delete the users entry
			$users->delete();

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


	 public function activateUser($token)
    {
        if ($user = $this->activation_service->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }

}
