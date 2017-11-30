<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function all_categories()
    {   
        $categories = Category::all();
        return response()->json(['categories' => $categories], 200);
    }

    public function users_categories()
    {   
        $users_categories = Category::where('user_id', Auth::user()->id)->get();
        return response()->json(['my_categories' => $users_categories], 200);
    }

    public function store(CategoryRequest $request, Category $category)
    {
        $user = Auth::user();
        $inputs = $request->only('title');
        $inputs['user_id'] = $user->id;
        if ($category = $category->create($inputs)) {
            return response()->json(['added_category' => $inputs], 200);
        }       
        else {
            return response()->json(['added_category' => 'Something went wrong!']);

        }
    }

    public function update(CategoryRequest $request, $id)
    {
        $inputs = $request->only('title');
        $result = Category::where('id', $id)->update($inputs);
        $categories_new_name = Category::where('id', $id)->get();
        if ($result) {
            return response()->json(['msg' => $categories_new_name]);
        }
        else {
            return response()->json(['msg' => 'Something went wrong!']);

        }
    }

    public function destroy($id)
    {  
        $result = Category::where('id', $id)->delete();
        if ($result) {
            return response()->json(['deleted_cats_id' => $id]);
        } 
        return response()->json(['error' => 'Something went wrong, please try again!']);
    }
}
