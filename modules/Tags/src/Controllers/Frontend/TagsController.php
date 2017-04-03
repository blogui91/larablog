<?php namespace Modules\Tags\Src\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Modules\Tags\Src\Repositories\TagRepositoryInterface;

class TagsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TagRepositoryInterface $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$tags = Role::orderBy('id', 'desc')->paginate(10);
        $tags = $this->tags->createModel()->orderBy('id','desc')->paginate(10);
        // $id = null;
        // $user = [
        //     'last_name' => 'Cesar Santana',
        //     'email' => 'casc.santana@gmail.com'
        // ];

        // list($messages) = $this->tags->store($id, $user);

        // dd($messages->isEmpty());
        // return $this->tags->validForUpdate($user);

        // return $this->tags->grid();
        return view('Tags.index', compact('tag'));
    }

     /**
     * Shows the form for creating a new user.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        return $this->showForm('create');
    }

    /**
     * Handle posting of the form for creating a new user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        return $this->processForm('create');
    }

    /**
     * Shows the form for updating a role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->showForm('update', $id);
    }

    /**
     * Handle posting of the form for updating a role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        return $this->processForm('update', $id);
    }

    /**
     * Removes the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $type = $this->tags->delete($id) ? '' : 'no';
        $status = $type == 'no' ? 'withErrors' : 'withSuccess' ;

        return redirect()->back()->{$status}(['deleted_resource' => 'The tag has '.$type.' been deleted']);
    }

   
    /**
     * Shows the form.
     *
     * @param  string  $mode
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    protected function showForm($mode, $id = null)
    {
        // Do we have a tag identifier?
        if (isset($id))
        {
            if ( ! $tag = $this->tags->find($id))
            {
               return redirect()->back()->withErrors(['not_found' => trans('cuadrangular/complaints::complaints/message.not_found')]);
            }
        }
        else
        {
            $tag = $this->tags->createModel();
        }

        // Show the page
        return view('Tags.edit', compact('mode', 'tag'));
    }

    /**
     * Processes the form.
     *
     * @param  string  $mode
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function processForm($mode, $id = null)
    {
        // Store the user
        list($messages) = $this->tags->store($id, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {
            return redirect()->back()->with('success', trans("modules/tag::message.success.{$mode}"));
        }

        return redirect()->back()->withInput()->withErrors($messages);
    }
   
}
