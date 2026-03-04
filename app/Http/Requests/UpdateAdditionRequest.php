<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdditionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:seniority,position,production,holiday,year_end,meal',
            'name' => 'required|string|max:50',
            'unit_price' => 'required_if:type,meal|nullable|numeric|min:0',
            'quantity' => 'required_if:type,meal|nullable|numeric|min:0',
            'amount' => 'required_unless:type,meal|nullable|numeric|min:0',
            'is_regular_wage' => 'required|in:0,1',
        ];
    }
}
