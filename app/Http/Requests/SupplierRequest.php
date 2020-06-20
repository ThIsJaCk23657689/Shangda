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
            'name' => 'required|string|max:100',
            'shortName' => 'nullable|string|max:100',
            'taxId' => 'nullable|string|max:8',
            'tel' => 'nullable|string|max:20',
            'phone_day' => 'nullable|string|max:20',
            'phone_night' => 'nullable|string|max:20',
            'tax' => 'nullable|string|max:20',
            'comment' => 'nullable|string|max:255',

            'operator_name_1' => 'required|string|max:50',
            'operator_tel_1' => 'required_without:operator_phone_1|string|max:20',
            'operator_phone_1' => 'required_without:operator_tel_1|string|size:10',
            'operator_email_1' => 'nullable|email|max:100',

            'operator_name_2' => 'nullable|string|max:50',
            'operator_tel_2' => 'nullable|string|max:20',
            'operator_phone_2' => 'nullable|string|size:10',
            'operator_email_2' => 'nullable|email|max:100',

            'companyAddress_zipcode' => 'required|string|max:5',
            'companyAddress_county' => 'required|string|max:10',
            'companyAddress_district' => 'required|string|max:10',
            'companyAddress_others' => 'required|string|max:255',

            'bank_name' => 'nullable|string|max:50',
            'bank_branch_name' => 'nullable|string|max:50',
            'bank_code' => 'nullable|string|max:50',
            'bank_account' => 'nullable|string|max:50',
            'bank_account_name' => 'nullable|string|max:50',
            'payment_method' => 'nullable|string|size:1',
            'monthlyCheckDate' => 'nullable|integer|min:0|max:31',
        ];
    }
}
