<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Auth;
use App\Category;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {   
        $category = Category::all();

        return view('/category/index', ['category' =>$category ]); 
    
    }

    public function create()
    {
        return view('category/create');
    }

    public function store(CategoryRequest $request)
    {
        $user = Auth::user();
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        unset($inputs['_method']);
        unset($inputs['_token']);
        if ($this->category->create($inputs)) {
            return redirect()->back()->with(['msg' => 'Your Category created!']);
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', ['category' => $category ]); 
    }

    public function update(CategoryRequest $request, $id)
    {
        $inputs = $request->all();
        unset($inputs['_method']);
        unset($inputs['_token']);
        $cat_update = Category::where('id', $id)->update($inputs);
        if ($cat_update) {
            return redirect()->back()->with(['msg' => 'Your Category Updated!']);
        }
    }

    public function destroy(Request $request, $id)
    {  
        $deleted = Category::where('id', $id)->delete();
        if ($deleted) {
            return redirect()->back()->with(['success' => 'Your Category Deleted!']);
        } 
        return redirect()->back()->with(['error' => 'Something went wrong, please try again!']);
    }
}
