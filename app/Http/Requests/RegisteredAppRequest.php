<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredAppRequest extends FormRequest
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
            'uuid' => 'nullable',
            'email' => 'required|email|unique:register_apps',
            'app_name' => 'required|string',
            'app_desc' => 'required|string',
            'brand_name' => 'required|string',
        ];
    }
}
