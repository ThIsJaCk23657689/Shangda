<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartDetailRequest extends FormRequest
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
            'cart_id' => 'required|integer|exists:carts,id|min:1',
            'product_id' => 'required|integer|exists:products,id|min:1',
        
            'price.*'  => 'nullable|min:0|numeric',
            'quantity.*' => 'required|integer',
            'discount.*'  => 'nullable|min:0|numeric',
            'subTotal.*'  => 'nullable|min:0|numeric',
            'comment.*' => 'nullable|max:255|string',
        ];
    }
}
