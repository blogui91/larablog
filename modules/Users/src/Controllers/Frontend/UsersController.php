<?php namespace Modules\Users\Src\Controllers\Frontend;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use  App\Http\Controllers\Auth\ActivationService;

use Modules\Users\Src\Repositories\UserRepositoryInterface;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activation_service, UserRepositoryInterface $users)
    {
        $this->activation_service = $activation_service;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$users = User::orderBy('id', 'desc')->paginate(10);
        $users = $this->users->createModel()->orderBy('id','desc')->paginate(10);
        // $id = null;
        // $user = [
        //     'last_name' => 'Cesar Santana',
        //     'email' => 'casc.santana@gmail.com'
        // ];

        // list($messages) = $this->users->store($id, $user);

        // dd($messages->isEmpty());
        // return $this->users->validForUpdate($user);

        // return $this->users->grid();
        if(request()->ajax()){
            return response()->json($users,200);
        }


        return view('Users.index', compact('users'));
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
     * Shows the form for updating a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->showForm('update', $id);
    }

    /**
     * Handle posting of the form for updating a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        return $this->processForm('update', $id);
    }

    /**
     * Removes the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $type = $this->users->delete($id) ? '' : 'no';
        $status = $type == 'no' ? 'withSuccess' : 'withErrors';

        return redirect()->back()->{$status}(['deleted_resource' => 'The users has '.$type.' been deleted']);
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
        // Do we have a users identifier?
        if (isset($id))
        {
            if ( ! $users = $this->users->find($id))
            {
               return redirect()->back()->withErrors(['not_found' => trans('cuadrangular/complaints::complaints/message.not_found')]);
            }
        }
        else
        {
            $users = $this->users->createModel();
        }

        // Show the page
        return view('Users.edit', compact('mode', 'users'));
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
        list($messages) = $this->users->store($id, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {
            return redirect()->back()->with('success', trans("platform/users::message.success.{$mode}"));
        }

        $this->alerts->error($messages, 'form');

        return redirect()->back()->withInput()->withErrors($messages);
    }
   
}
