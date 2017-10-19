<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
	public function authorize()
	{
	    return true;
	}

	 
    public function rules()
    {
        return [
            'post_title' => 'required|max:255',
            'text' => 'required',
            'cat_name' => 'required|max:255',
            //'image' => 'required|image|mimes:jpeg,jpg,bnp,png|between:0,5000'
        ];
    }

   	public function messages()
   	{
        return [
            'post_title.required' => 'Post Title field is required!',
            'text.required' => 'Text Field is required!',
            'cat_name.required' => 'Category Name is required!',
        ];
    }

}