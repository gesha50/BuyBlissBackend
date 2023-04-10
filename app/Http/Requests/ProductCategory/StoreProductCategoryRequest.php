<?php

namespace App\Http\Requests\ProductCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategoryRequest extends FormRequest
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
            'title' => 'required | max:255 | unique:product_categories,title',
            'slug' => 'max:255 | unique:product_categories,slug',
            'img' => 'image',
            'level' => 'integer | min:0 | max:1',
            'product_category_id' => 'exists:App\Models\ProductCategory,id'
        ];
    }
}
