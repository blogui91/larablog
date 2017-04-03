<?php namespace Modules\Posts\Src\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Modules\Posts\Src\Repositories\PostRepositoryInterface;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = $this->posts->createModel()->orderBy('id','desc')->paginate(10);

        if(request()->has('with_json_response') || request()->ajax()){
            return response()->json($posts,200);
        }

        return view('frontend.posts.index', compact('posts'));
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
        $type = $this->posts->delete($id) ? '' : 'no';
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
            if ( ! $post = $this->posts->findBySlug($id))
            {
               return redirect()->back()->withErrors(['not_found' => trans('cuadrangular/complaints::complaints/message.not_found')]);
            }
        }
        else
        {
            $post = $this->posts->createModel();
        }


        if(request()->has('with_json_response')){
            return response()->json($post,200);
        }

        // Show the page
        return view('frontend.posts.show', compact('mode', 'post'));
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
        list($messages) = $this->posts->store($id, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {
            return redirect()->back()->with('success', trans("platform/multimedias::message.success.{$mode}"));
        }

        return redirect()->back()->withInput()->withErrors($messages);
    }
   
}
