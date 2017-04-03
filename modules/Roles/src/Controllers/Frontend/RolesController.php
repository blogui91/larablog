<?php namespace Modules\Roles\Src\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Modules\Roles\Src\Repositories\RoleRepositoryInterface;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleRepositoryInterface $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$roles = Role::orderBy('id', 'desc')->paginate(10);
        $roles = $this->roles->createModel()->orderBy('id','desc')->paginate(10);
        // $id = null;
        // $user = [
        //     'last_name' => 'Cesar Santana',
        //     'email' => 'casc.santana@gmail.com'
        // ];

        // list($messages) = $this->roles->store($id, $user);

        // dd($messages->isEmpty());
        // return $this->roles->validForUpdate($user);

        // return $this->roles->grid();
        return view('Roles.index', compact('roles'));
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
        $type = $this->roles->delete($id) ? '' : 'no';
        $status = $type == 'no' ? 'withErrors' : 'withSuccess' ;

        return redirect()->back()->{$status}(['deleted_resource' => 'The roles has '.$type.' been deleted']);
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
        // Do we have a roles identifier?
        if (isset($id))
        {
            if ( ! $roles = $this->roles->find($id))
            {
               return redirect()->back()->withErrors(['not_found' => trans('cuadrangular/complaints::complaints/message.not_found')]);
            }
        }
        else
        {
            $roles = $this->roles->createModel();
        }

        // Show the page
        return view('Roles.edit', compact('mode', 'roles'));
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
        list($messages) = $this->roles->store($id, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {
            return redirect()->back()->with('success', trans("platform/roles::message.success.{$mode}"));
        }

        $this->alerts->error($messages, 'form');

        return redirect()->back()->withInput()->withErrors($messages);
    }
   
}
