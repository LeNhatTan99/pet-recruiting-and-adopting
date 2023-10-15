<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
        $id = auth()->user() ? auth()->user()->id : null;
        return [
            'username' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('users', 'username')->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'phone_number' => [
                'required',
                'min:10',
                'max:16',
                Rule::unique('users', 'phone_number')->ignore($id)
            ],
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'address' => 'required|max:255',
            'password' => [
                $id ? 'nullable' : 'required',
                'min:6',
                'max:255',
            ],
        ];
    }
}
