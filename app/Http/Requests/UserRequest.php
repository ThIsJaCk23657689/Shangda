<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'jobTitle' => 'required|integer|exists:job_titles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|boolean',
            'birthday' => 'nullable|date',

            'zipcode' => 'nullable|string|size:3',
            'county' => 'nullable|string|max:10',
            'district' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
        ];
    }
}
