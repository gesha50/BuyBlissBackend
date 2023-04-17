<?php

namespace App\Http\Requests\Size;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSizeRequest extends FormRequest
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
            'title' => '',
            'length' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
            'product_id' => 'exists:App\Models\Product,id'
        ];
    }
}
