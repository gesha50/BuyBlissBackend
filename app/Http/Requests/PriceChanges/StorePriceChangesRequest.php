<?php

namespace App\Http\Requests\PriceChanges;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceChangesRequest extends FormRequest
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
            'new_price' => 'integer|max:10',
            'price_with_discount' => 'integer|max:10',
            'discount_finish_at' => 'date_format:Y-m-d H:i:s',
            'product_id' => 'exists:App\Models\Product,id'
        ];
    }
}
