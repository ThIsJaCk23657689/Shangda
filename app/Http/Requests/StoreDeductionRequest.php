<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeductionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:labor_insurance,health_insurance,service_fee,water,electricity,housing,advance,other',
            'name' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
        ];
    }
}
