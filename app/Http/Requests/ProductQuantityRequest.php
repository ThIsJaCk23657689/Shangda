<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductQuantityRequest extends FormRequest
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
            'product_id' => 'required|integer|exists:product,id',
            'user_id' => 'required|integer|exists:user,id',
            'last_user_id' => 'required|integer|exists:last_user_id,id',
            'quantity' => 'required|integer|min:0',
        ];
    }
}
