<?php

namespace App\Http\Requests\SpecificationCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecificationCategoryRequest extends FormRequest
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
            'title' => 'required|max:255|unique:specification_categories,title',
            'is_img' => 'boolean'
        ];
    }
}
