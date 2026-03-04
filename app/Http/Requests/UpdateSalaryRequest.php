<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalaryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'base_salary' => 'required|numeric|min:0',
            'health_insurance_dependents' => 'required|integer|min:0|max:3',
            'note' => 'nullable|string|max:500',
        ];
    }
}
