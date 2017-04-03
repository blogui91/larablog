<?php namespace Modules\Posts\Src\Repositories;

use App\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;
use Modules\Posts\Src\Validators\PostValidatorInterface;
use Modules\Posts\Src\Repositories\PostRepositoryInterface;
use Auth;

use Purifier;

class PostRepository implements PostRepositoryInterface {

	use Traits\ContainerTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Eloquent post model.
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
	public function __construct(Container $app, PostValidatorInterface $validator)
	{
		$this->setContainer($app);

		$this->validator = $validator;

		$this->setModel(get_class($app['Modules\Posts\Src\Models\Post']));
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
	public function findBySlug($id)
	{
		return $this->createModel()->whereSlug($id)->orWhere('id', $id)->first();
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
		// Create a new post
		$post = $this->createModel();

		$input = $this->prepareData($input);
		
		$input['updated_by'] = Auth::user()->id;
		$input['published_by'] = Auth::user()->id;

		$tags = request()->get('tags',[]);

		// Validate the submitted data
		$messages = $this->validForCreation($input);
		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the post
			$post->fill($input)->save();
			$this->syncTags($post->id, $tags);
		}

		return [ $messages, $post ];
	}


	public function syncTags(int $id,array $tags)
	{
		$post = $this->createModel()->find($id);

		$post->tags()->sync($tags);

		$post->save();
	}





	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the post object
		$post = $this->find($id);

		//Prepare data
		$input = $this->prepareData($input);
		
		$this->validator->setModel($post);
		// Validate the submitted data

		$tags = request()->get('tags',[]);

		$input['updated_by'] = Auth::user()->id;

		if(!isset($input['published_by'])){
			$input['published_by'] = null;
		}
		unset($input['published_by']);

		$messages = $this->validForUpdate($input);

		
		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the post
			$post->fill($input)->save();
			$this->syncTags($post->id, $tags);
			
		}

		return [ $messages, $post ];
	}


	public function prepareData(array $input)
	{
		if(isset($input['published'])){
			if($input['published'] == 'on') $input['published'] = "1";
			if($input['published'] == 'off') $input['published'] = "0";
		}

		if(isset($input['description'])){
			//$input['description'] = Purifier::clean($input['description']);
		}

		return $input;
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the post exists
		if ($post = $this->find($id))
		{
			// Delete the post entry
			$post->delete();
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
