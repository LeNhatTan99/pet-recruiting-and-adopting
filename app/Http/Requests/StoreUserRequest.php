<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|unique:users,username,'. $this->route('id'),
            'email' => 'required|email|unique:users,email,'. $this->route('id'),
            'phone_number' => 'required|numeric|unique:users,phone_number,'. $this->route('id'),
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'address' => 'required|max:255',
            'password' => [
                $this->route('id') ? 'nullable' : 'required',
                'min:6',
                'max:255',
            ],
        ];
    }
}
