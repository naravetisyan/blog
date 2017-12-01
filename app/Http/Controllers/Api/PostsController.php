<?php
namespace App\Http\Controllers\Api;

use Auth;
use App\Http\Controllers\Controller;
use \App\Http\Requests\PostRequest;
use App\Post;
use App\Category;

class PostsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allPosts()
    {
        $all_posts = Post::with('category')->get();
        return response()->json(['posts' => $all_posts], 200);
    }

    public function usersPosts()
    {   
        $users_posts = Post::where('user_id', Auth::user()->id)->with('category')->get();
        return response()->json(['my_posts' => $users_posts], 200);
    }

    public function store(PostRequest $request)
    {   
        $inputs = $request->except('image');
        $default_image = 'empty.jpeg';
        $path = public_path('/images');
        if ($image =  $request->file('image')) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move($path, $image_name);
        }
        $inputs['image'] = $image_name ? $image_name : $default_image;
        $inputs['user_id'] = Auth::id();
        if ($post->create($inputs)) {
            $inputs['category'] = Category::where('id', $request->category_id)->get();
            return response()->json(['added_post' => $inputs]);
        }
        return response()->json(['error' => 'Something went wrong!']);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return response()->json(['post' =>$post,'categories'=> $categories ]); 
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $user = Auth::user();
        $image_name = 'empty.jpg';
        if ($image =  $request->file('image')) {
            $path = public_path('/images');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move($path, $image_name);
        }
        $inputs = $request->except('_method');
        $inputs['image'] = $image_name;
        if($result = $post->update($inputs)) {
            $inputs['category'] = Category::where('id', $request->category_id)->get();
            return response()->json(['edited_post' => $inputs]);
        }
        return response()->json(['error' => 'Something went wrong!']);
    }

    public function destroy($id)
    {
        $result = Post::where('id', $id)->delete();
        if ($result) {
            return response()->json(['deleted_posts_id' => $id]);
        } 
        return response()->json(['error' => 'Something went wrong, please try again!']);
    }
}
