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
            'account' => 'required|string|min:6|max:30|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|boolean',
            'birthday' => 'nullable|date',
            'tel' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',

            'address_zipcode' => 'nullable|string|size:3',
            'address_county' => 'nullable|string|max:10',
            'address_district' => 'nullable|string|max:10',
            'address_others' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
        ];
    }
}
