<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The category name field is required.'
        ];
    }
}