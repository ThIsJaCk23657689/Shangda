<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleOrderRequest extends FormRequest
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
            'consumers_id' => 'required',
            'user_id' => 'required',

            'expectPay_at' => 'nullable|date',
            'paid_at' => 'nullable|date',
            'expectDeliver_at' => 'nullable|date',
            'delivered_at' => 'nullable|date',
            'makeInvoice_at' => 'nullable|date',

            'piadAmount' => 'nullable|min:0|numeric',
            'unpiadAmount' => 'nullable|min:0|numeric',
            'totalPrice' => 'nullable|min:0|numeric',
            'taxPrice' => 'nullable|min:0|numeric',
            'totalTaxPrice' => 'nullable|min:0|numeric',

            'comment' => 'nullable|string',
            'taxType' => 'nullable|min:1|max:6',
            'invoiceType' => 'nullable|min:1|max:5',
            'address' => 'nullable|max:255|string',
        ];
    }
}
