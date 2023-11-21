<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'category_id' => "required|exists:categories,id",
            'shownID' => 'required|string|max:255',
            'isManualID' => 'nullable|boolean',
            'name' => 'required|string|max:255',
            'isManualNamed' => 'nullable|boolean',
            'internationalNum' => 'nullable|string|max:20',
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,bmp|max:2048',
            'specification' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'isCustomize' => 'nullable|boolean',
            'isPublic' => 'nullable|boolean',
            'showPrice' => 'nullable|boolean',

            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'chamfer' => 'nullable|numeric|min:0',

            'weight' => 'nullable|numeric|min:0',
            'qty_per_pack' => 'nullable|integer|min:0',
            'unit' => 'nullable|string|max:100',
            'intro' => 'nullable|string',

            'quantity' => 'nullable|integer|min:0',
            'safeQuantity' => 'nullable|integer|min:0',
            'comment' => 'nullable|string',

            'recipes.*.material_id' => "nullable|exists:materials,id|integer",
            'recipes.*.ratio' => 'nullable|numeric',

            'profit' => 'required|numeric',
        ];
    }
}
