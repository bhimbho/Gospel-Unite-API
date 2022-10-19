<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class CreateBooksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cover' => 'required|image|max:1000',
            'title' => 'required|unique:songs,title',
            'description' => 'nullable',
            'author' => 'required',
            'tags.*' => 'required|numeric'
        ];
    }
}
