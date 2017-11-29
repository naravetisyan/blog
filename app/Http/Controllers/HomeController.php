<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $category = Category::all();
        $post = Post::paginate(4);
        $my_categories = Category::where('user_id', $user->id)->get();
        $my_posts = Post::where('user_id', $user->id)->get();
        return view('home')->with([
                                    'user' => $user,
                                    'category'=>$category,
                                    'post'=>$post, 
                                    'my_categories' => $my_categories,
                                    'my_posts' => $my_posts 
                                ]); 
    }
}
