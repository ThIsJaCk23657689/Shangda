<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'discounts.*.product_id' => 'required_without:discounts.*.consumer_id|integer|exists:products,id',
            'discounts.*.consumer_id' => 'required_without:discounts.*.product_id|integer|exists:consumers,id',
            'discounts.*.relativePrice' => 'required|numeric',
            'discounts.*.absolutePirce' => 'nullable|numeric',
        ];
    }
}
