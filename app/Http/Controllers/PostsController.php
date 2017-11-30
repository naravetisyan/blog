<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\PostRequest;
use Auth;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Storage;
use File;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $post = Post::all();
        return view('posts.index', ['post' => $post ]); 
    }

    public function create()
    {
        return view('posts.create',['categories' => $categories = Category::all()]);
    }

    public function store(PostRequest $request, Post $post)
    {   
        $user = Auth::user();
        $default_image = 'empty.jpeg';
        $path = public_path('/images');
        if ($image =  $request->file('image')) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move($path, $image_name);
        }
        $inputs = [
            'title' => $request->post_title,
            'text' => $request->text,
            'category_id' => $request->cat_name,
            'user_id' => $user->id,
            'image' => $image = isset($image_name) ? $image_name : $default_image
        ];
        if ($post->create($inputs)) {
            return redirect()->back()->with(['msg' => 'Your Post created!']);
        }
        else {
            return redirect()->back()->with(['msg' => 'Something went wrong!']);
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', ['post' => $post ]); 
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.edit', ['post' =>$post,'categories'=> $categories ]); 
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->only('title','text','category_id');
        $post = Post::find($id);
        $current_image = public_path('/images').'/'.$post->image;
        $path = public_path('/images');

        if ($image =  $request->file('image')) {
            File::delete($current_image);
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move($path, $image_name);
        }
        else {
            $image_name = $post->image;
        }
        $inputs['image'] = $image_name;
        if ($result = Post::where('id', $id)->update($inputs)) {
            return redirect()->back()->with(['msg' => 'Your Post Updated!']);
        }
        else {
            return redirect()->back()->with(['msg' => 'Something went wrong!']);
        }
    }

    public function destroy($id)
    {
        $result = Post::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->with(['success' => 'Your Post Deleted!']);
        } 
        return redirect()->back()->with(['error' => 'Something went wrong, please try again!']);
    }
}
