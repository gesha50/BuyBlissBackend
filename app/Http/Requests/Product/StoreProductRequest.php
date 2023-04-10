<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => 'required | max:128 | unique:products,title',
            'description' => 'max:255',
            'full_title' => 'max:256 | unique:products,full_title',
            'full_description' => '',
            'meta_title' => 'max:128 | unique:products,meta_title',
            'meta_description' => 'max:255',
            'is_active' => 'required | boolean',
            'is_error' => 'required | boolean',
        ];
    }
}
