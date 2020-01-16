<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        'category_id'=>"required|exists:categories,id",
        'name' => 'required|max:100|string',
        'shortName' => 'nullable|max:100|string',
        'internationalNum' => 'nullable|max:100|string',

        'fundamentalPrice' => 'required|numeric|min:0',
        // 'retailPrice' => 'required|numeric|min:0',
        'materialCoefficient1' => 'required|numeric|min:0',
        'materialCoefficient2' => 'required|numeric|min:0',
        'materialCoefficient3' => 'required|numeric|min:0',
        'materialCoefficient4' => 'required|numeric|min:0',
        'materialCoefficient5' => 'required|numeric|min:0',

        'comment' => 'nullable|string',
        'unit' => 'nullable|string|max:100',
        'quantity' => 'required|integer|min:0',
        'safeQuantity' => 'required|integer|min:0',
        'picture' => 'nullable|string',
        'intro' => 'nullable|string',
        'specification' => 'nullable|string',
        ];
    }
}
