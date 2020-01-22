<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduceDetailRequest extends FormRequest
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
            'produce_id' => 'required|integer|exists:produces,id',
            'material_id.*' => 'required|integer|exists:materials,id',
            'quantity.*' => 'required|integer|min:0',
        ];
    }
}
