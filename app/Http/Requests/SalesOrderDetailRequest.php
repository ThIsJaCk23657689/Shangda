<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesOrderDetailRequest extends FormRequest
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
            'product_id.*' => 'required|integer',
            'salesOrder_id.*' => 'required|integer',
            
            'price.*'  => 'nullable|min:0|numeric',
            'quantity.*' => 'required|integer',
            'discount.*'  => 'nullable|min:0|numeric',
            'comment.*' => 'nullable|max:255|string',
        ];
    }
}
