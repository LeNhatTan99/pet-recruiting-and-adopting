<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnimalRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => 'required|max:500',
            'media' =>($this->route('id') ? '' : '|required'),
            'age' => 'required|numeric',
            'name' => 'required|max:50',
            'breed' => 'required',
            'type' => 'required',
            'status' => 'required',
            'gender' => 'required',
        ];
    }
}
