<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
            'internationalNum' => 'nullable|max:25|string',
            'unit' => 'required|integer|min:1|max:2',
            'unitPrice' => 'required|numeric|min:0',
            'comment' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'picture' => 'nullable|string',

        ];
    }
}
