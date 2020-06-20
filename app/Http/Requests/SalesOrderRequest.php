<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesOrderRequest extends FormRequest
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
            'consumer_id' => 'required|exists:consumers,id',

            'expectPay_at' => 'required|date',
            'paid_at' => 'nullable|date',
            'expectDeliver_at' => 'required|date',
            'delivered_at' => 'nullable|date',
            'makeInvoice_at' => 'nullable|date',

            'piadAmount' => 'nullable|min:0|numeric',
            'unpiadAmount' => 'nullable|min:0|numeric',
            'totalPrice' => 'nullable|min:0|numeric',
            'taxPrice' => 'nullable|min:0|numeric',
            'totalTaxPrice' => 'nullable|min:0|numeric',

            'comment' => 'nullable|string|max:255',
            'taxType' => 'required|min:1|max:6',
            'status' => 'required|min:1|max:2',
            'invoiceType' => 'required|min:1|max:5',
            'address' => 'nullable|string|max:255',
            // 'who_created' => 'required|integer|max:1|min:0',
            'confirmStatus' => 'required|integer|max:2|min:0',
        ];
    }
}
