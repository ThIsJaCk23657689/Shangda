<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'gender' => 'nullable|in:0,1',
            'nationality' => 'nullable|string|max:50',
            'id_type' => 'nullable|in:1,2,3',
            'id_number' => 'nullable|string|max:20|unique:employees,id_number',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address_zipcode' => 'nullable|string|max:10',
            'address_county' => 'nullable|string|max:20',
            'address_district' => 'nullable|string|max:20',
            'address_others' => 'nullable|string|max:200',
            'base_salary' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:0,1',
            'hired_date' => 'nullable|date',
            'resigned_date' => 'nullable|date|required_if:status,0|after_or_equal:hired_date',

            'bank_accounts' => 'required|array|min:1',
            'bank_accounts.*.bank_code' => 'required|string|max:10',
            'bank_accounts.*.bank_name' => 'required|string|max:50',
            'bank_accounts.*.account_number' => 'required|string|max:30',
            'bank_accounts.*.is_primary' => 'required|in:0,1',

            'emergency_contacts' => 'nullable|array',
            'emergency_contacts.*.relationship' => 'required_with:emergency_contacts|string|max:20',
            'emergency_contacts.*.name' => 'required_with:emergency_contacts|string|max:50',
            'emergency_contacts.*.phone' => 'required_with:emergency_contacts|string|max:20',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => '驗證失敗',
            'errors' => $validator->errors(),
        ], 422));
    }
}
