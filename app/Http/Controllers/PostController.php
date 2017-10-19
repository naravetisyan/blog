<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\PostRequest;
use Auth;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Storage;
use File;

class PostController extends Controller
{
    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function index()
    {
        $post = Post::all();
        return view('post.index', ['post' => $post ]); 
    }

    public function create()
    {
        return view('post.create',['categories' => $categories = Category::all()]);
    }

    public function store(PostRequest $request)
    {
        $user = Auth::user();
        $default_image = 'empty.jpeg';
        $path = public_path('/images');
        if ($image =  $request->file('image')) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move($path, $image_name);
        }
        if ($this->post->create(['title' => $request->post_title, 'text' => $request->text,'category_id' => $request->cat_name, 'user_id' => $user->id, 'image' => $image = isset($image_name) ? $image_name : $default_image])) {
            return redirect()->back()->with(['msg' => 'Your Post created!']);
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', ['post' => $post ]); 
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('post.edit', ['post' =>$post,'categories'=> $categories ]); 
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        unset($inputs['_method']);
        unset($inputs['_token']);
        $post = Post::find($id);
        //if (!Storage::url('empty.jpeg')) {
            $image_path = public_path('/images').'/'.$post->image;
            File::delete($image_path);
        //}
        $path = public_path('/images');
        if ($image =  $request->file('image')) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move($path, $image_name);
        }
        else{
            //$image_name='empty.jpeg';
            $image_name = $post->image;
        }
        $inputs['image'] = $image_name;
        $post_update = Post::where('id', $id)->update($inputs);
        if ($post_update) {
            return redirect()->back()->with(['msg' => 'Your Post Updated!']);
        }
    }

    public function destroy(Request $request, $id)
    {
        $deleted = Post::where('id', $id)->delete();
        if ($deleted) {
            return redirect()->back()->with(['success' => 'Your Post Deleted!']);
        } 
        return redirect()->back()->with(['error' => 'Something went wrong, please try again!']);
    }
}
