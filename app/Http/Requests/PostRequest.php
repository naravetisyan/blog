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
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required|max:255'
        ];
    }

   	public function messages()
   	{
        return [
            'title.required' => 'Post Title field is required!',
            'text.required' => 'Text Field is required!',
            'category_id.required' => 'Category Name is required!',
        ];
    }

}