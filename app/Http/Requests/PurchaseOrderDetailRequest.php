<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderDetailRequest extends FormRequest
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
            'material_id.*' => 'required|integer',
            'purchaseOrder_id' => 'required|integer',
            
            'subTotal.*' => 'required|min:0|numeric',
            'count.*' => 'required|min:0|integer',
            'price.*' => 'required|min:0|numeric',
            'quantity.*' => 'required|integer',
            'comment.*' => 'nullable|max:255|string',
            'discount.*' => 'required|min:0|max:1|numeric',
        ];
    }
}
