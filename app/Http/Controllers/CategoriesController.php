<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Auth;
use App\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('/categories/index', ['categories' =>$categories ]); 
    }

    public function create()
    {
        return view('categories/create');
    }

    public function store(CategoryRequest $request, Category $category)
    {
        $user = Auth::user();
        $inputs = $request->only('title');
        $inputs['user_id'] = $user->id;
        if ($category->create($inputs)) {
            return redirect()->back()->with(['msg' => 'Your Category created!']);
        }
        else {
            return redirect()->back()->with(['msg' => 'Something went wrong!']);
        }
    }
    
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', ['category' => $category ]); 
    }

    public function update(CategoryRequest $request, $id)
    {
        $inputs = $request->only('title');
        $result = Category::where('id', $id)->update($inputs);
        if ($result) {
            return redirect()->back()->with(['msg' => 'Your Category Updated!']);
        }
        else {
            return redirect()->back()->with(['msg' => 'Something went wrong!']);
        }
    }

    public function destroy($id)
    {  
        $result = Category::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->with(['success' => 'Your Category Deleted!']);
        } 
        return redirect()->back()->with(['error' => 'Something went wrong, please try again!']);
    }
}
