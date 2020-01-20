<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductQuantityDetailRequest extends FormRequest
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
            'product_quantity_id.*' => 'required|integer|exists:productQuantities,id',
            'material_id.*' => 'required|integer|exists:materia,id',
            'quantity.*' => 'required|integer|min:0',
        ];
    }
}
