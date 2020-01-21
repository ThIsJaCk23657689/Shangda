<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsumerEditRequest extends FormRequest
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
            // 'discount_id' => 'required',
            'name' => 'required|max:100|string',
            'shortName' => 'nullable|max:100|string',
            'taxID' => 'nullable|max:8|string',
            'idNumber' => 'nullable|max:10|string',


            'inCharge1' => 'required|max:50|string',
            'tel1' => 'required|max:25|string',
            'email1' => 'nullable|max:100|string',
            'inCharge2' => 'nullable|max:50|string',
            'tel2' => 'nullable|max:25|string',
            'email2' => 'nullable|max:100|string',

            'tax' => 'nullable|max:25|string',
            'monthlyCheckDate' => 'nullable|min:1|max:31|integer',
            'uncheckedAmount' => 'nullable|min:0|numeric',
            'totalConsumption' => 'nullable|min:0|numeric',
            'comment' => 'nullable|string',
            'companyAddress' => 'required|max:255|string',
            'deliveryAddress' => 'required|max:255|string',
            'invoiceAddress' => 'required|max:255|string',
        ];
    }
}
