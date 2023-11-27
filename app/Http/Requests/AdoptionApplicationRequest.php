<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdoptionApplicationRequest extends FormRequest
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
            'reason' => 'required|min:10|max:255', 
            'link_social' => 'required|max:255', 
            'front_side_ID_card' => 'required', 
            'back_side_ID_card' => 'required', 
        ];
    }
}
