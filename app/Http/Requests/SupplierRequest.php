<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name' => 'required|max:100|string',
            'shortName' => 'nullable|max:100|string',
            'taxId' => 'nullable|max:8|string',

            'tel' => 'nullable|max:25|string',
            'tax' => 'nullable|max:25|string',
            
            'inCharge1' => 'required|max:50|string',
            'tel1' => 'required|max:25|string',
            'email1' => 'nullable|max:100|email',
            'inCharge2' => 'nullable|max:50|string',
            'tel2' => 'nullable|max:25|string',
            'email2' => 'nullable|max:100|email',
            
            'companyAddress' => 'required|max:255|string',
            'deliveryAddress' => 'required|max:255|string',
            'invoiceAddress' => 'required|max:255|string',
            'comment' => 'nullable|string',
        ];
    }
}
