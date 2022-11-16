<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidSignUp extends FormRequest
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
            'email'=>'required|email|unique:users',
            'name'=>'required|string',
            'password'=>'required|string',
            'confirmation_password'=>'required|string|same:password',
        ];
    }
}
