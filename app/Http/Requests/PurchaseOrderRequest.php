<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderRequest extends FormRequest
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
            'supplier_id' => 'required|integer|exists:suppliers,id|min:1',
            'paid_at' => 'nullable|date',
            'received_at' => 'nullable|date',
            'expectReceived_at' => 'required|date',
            'totalPrice' => 'required|min:0|numeric',
            'comment' => 'nullable|max:255|string',
            'taxType' => 'nullable|min:1|max:6',
            'invoiceType' => 'nullable|min:1|max:5',
            'address' => 'nullable|max:255|string',
        ];
    }
}
