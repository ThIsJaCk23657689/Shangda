<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeductionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:service_fee,water,electricity,housing,advance,other',
            'name' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'is_regular_wage' => 'required|in:0,1',
        ];
    }
}
