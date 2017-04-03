<?php namespace Modules\Posts\Src\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Modules\Posts\Src\Repositories\PostRepositoryInterface;
use Modules\Tags\Src\Repositories\TagRepositoryInterface;
use Modules\Categories\Src\Repositories\CategoryRepositoryInterface;



class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $posts, TagRepositoryInterface $tags , CategoryRepositoryInterface $categories)
    {
        $this->posts = $posts;
        $this->categories = $categories;
        $this->tags = $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = $this->posts->createModel()->orderBy('id','desc')->paginate(10);
        return view('Posts.index', compact('posts'));
    }

    /**
     * Shows multimedia collection.
     *
     * @return Collection
     */
    public function grid()
    {
        $data = $this->posts->all();
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
        $type = $this->posts->delete($id) ? '' : 'no';
        $status = $type == 'no' ? 'withErrors' : 'withSuccess' ;

        return redirect()->back()->{$status}(['deleted_resource' => 'The post has '.$type.' been deleted']);
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
        // Do we have a posts identifier?
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

        $tags = $this->tags->all();
        $categories = $this->categories->all();

        // Show the page
        return view('Posts.form', compact('mode', 'post', 'categories', 'tags'));
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
        list($messages, $post) = $this->posts->store($id, request()->all());

        // Do we have any errors?
        if ($messages->isEmpty()) {

            if(request()->ajax()){
                return response()->json($post, 200);
            }

            return redirect()->route('admin.posts.all')->with('success', trans("platform/posts::message.success.{$mode}"));
        }

        if(request()->ajax()){
            return response()->json(['messages' => $messages], 422);
        }

        return redirect()->back()->withInput()->withErrors($messages);
    }
   
   
}
