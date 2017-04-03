<?php namespace Modules\Multimedia\Src\Controllers\Admin;

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
     * Shows multimedia collection.
     *
     * @return Collection
     */
    public function grid()
    {
        $data = $this->multimedias->all();
        return response()->json($data);
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
            if ( ! $multimedia = $this->multimedias->find($id))
            {
               return redirect()->back()->withErrors(['not_found' => trans('cuadrangular/complaints::complaints/message.not_found')]);
            }
        }
        else
        {
            $multimedia = $this->multimedias->createModel();
        }

        // Show the page
        return view('Multimedia.form', compact('mode', 'multimedia'));
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
        // Store the multimedia
        list($messages, $multimedia) = $this->multimedias->store($id, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {
            if(request()->ajax()){
                return response()->json($multimedia,200);
            }
            return redirect()->route('admin.multimedias.all')->with('success', trans("platform/multimedias::message.success.{$mode}"));
        }

        if(request()->ajax()){
                return response()->json(["error" => 'there was an error.', "messages" => $messages],404);
            }

        return redirect()->back()->withInput()->withErrors($messages);
    }


    protected function storeMultiple()
    {
       return $this->processForm('create');
    }
   
   
}
