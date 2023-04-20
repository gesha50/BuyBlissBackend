<?php

namespace App\Http\Requests\ProductImage;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'max:255',
            'img' => 'image',
            'product_id' => 'exists:App\Models\Product,id',
            'color_product_id' => 'exists:App\Models\ColorProduct,id',
            'is_poster' => 'required | boolean',
            'is_universal' => 'required | boolean',
        ];
    }
}
