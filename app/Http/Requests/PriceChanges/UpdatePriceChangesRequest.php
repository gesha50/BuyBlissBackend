<?php

namespace App\Http\Requests\PriceChanges;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceChangesRequest extends FormRequest
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
            'new_price' => '',
            'price_with_discount' => '',
            'discount_finish_at' => 'date_format:Y-m-d H:i:s',
            'product_id' => 'exists:App\Models\Product,id'
        ];
    }
}
