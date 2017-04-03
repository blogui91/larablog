<?php namespace Modules\Multimedia\Src\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Modules\Multimedia\Src\Repositories\MultimediaRepositoryInterface;

class MultimediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MultimediaRepositoryInterface $multimedias)
    {
        $this->multimedias = $multimedias;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$multimedias = Role::orderBy('id', 'desc')->paginate(10);
        $multimedias = $this->multimedias->createModel()->orderBy('id','desc')->paginate(10);
        // $id = null;
        // $user = [
        //     'last_name' => 'Cesar Santana',
        //     'email' => 'casc.santana@gmail.com'
        // ];

        // list($messages) = $this->multimedias->store($id, $user);

        // dd($messages->isEmpty());
        // return $this->multimedias->validForUpdate($user);

        // return $this->multimedias->grid();
        return view('Multimedia.index', compact('multimedias'));
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
     * Shows the form for updating a multimedia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->showForm('update', $id);
    }

    /**
     * Handle posting of the form for updating a multimedia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        return $this->processForm('update', $id);
    }

    /**
     * Removes the specified multimedia.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $type = $this->multimedias->delete($id) ? '' : 'no';
        $status = $type == 'no' ? 'withErrors' : 'withSuccess' ;

        return redirect()->back()->{$status}(['deleted_resource' => 'The multimedias has '.$type.' been deleted']);
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
        // Do we have a multimedias identifier?
        if (isset($id))
        {
            if ( ! $multimedias = $this->multimedias->find($id))
            {
               return redirect()->back()->withErrors(['not_found' => trans('cuadrangular/complaints::complaints/message.not_found')]);
            }
        }
        else
        {
            $multimedias = $this->multimedias->createModel();
        }

        // Show the page
        return view('Multimedia.edit', compact('mode', 'multimedias'));
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
        list($messages) = $this->multimedias->store($id, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {
            return redirect()->back()->with('success', trans("platform/multimedias::message.success.{$mode}"));
        }

        $this->alerts->error($messages, 'form');

        return redirect()->back()->withInput()->withErrors($messages);
    }
   
}
