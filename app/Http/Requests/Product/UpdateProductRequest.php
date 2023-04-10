<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'title' => [
                'required',
                'max:128',
                Rule::unique('products')
                    ->ignore(Product::where('id', $request->id)->first()->id)
            ],
            'description' => 'max:255',
            'full_title' => [
                'required',
                'max:256',
                Rule::unique('products')
                    ->ignore(Product::where('id', $request->id)->first()->id)
            ],
            'full_description' => '',
            'meta_title' => [
                'max:128',
                Rule::unique('products')
                    ->ignore(Product::where('id', $request->id)->first()->id)
            ],
            'meta_description' => 'max:255',
            'is_active' => 'required | boolean',
            'is_error' => 'required | boolean',
        ];
    }
}
