<?php

namespace App\Http\Requests\ProductCategory;

use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateProductCategoryRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'title' => ['max:255',
                Rule::unique('product_categories')
                    ->ignore(ProductCategory::where('id', $request->id)->first()->id)
            ],
            'slug' => [
                'max:255',
                Rule::unique('product_categories')
                    ->ignore(ProductCategory::where('id', $request->id)->first()->id)
            ],
            'img' => 'image',
            'level' => 'integer | min:0 | max:1',
            'product_category_id' => 'exists:App\Models\ProductCategory,id'
        ];
    }
}
