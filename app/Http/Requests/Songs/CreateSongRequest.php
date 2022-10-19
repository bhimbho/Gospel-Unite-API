<?php

namespace App\Http\Requests\Songs;

use Illuminate\Foundation\Http\FormRequest;

class CreateSongRequest extends FormRequest
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
            'cover' => 'image|max:2000',
            'song' => 'required|string',
            'title' => 'required|unique:songs,title',
            'description' => 'string',
            'release_date' => 'date',
            'artist' => 'required|string',
        ];
    }
}
