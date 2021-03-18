<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePost extends FormRequest
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
        $id = $this->segment(2);

        $rules = [
            'title' => [
                'required',
                'min:3',
                'max:160',
                Rule::unique('posts')->ignore($id),
            ],
            'content' => ['required', 'min:7', 'max:100000'],
            'image' => ['nullable', 'image']
        ];

        return $rules;
    }
}
