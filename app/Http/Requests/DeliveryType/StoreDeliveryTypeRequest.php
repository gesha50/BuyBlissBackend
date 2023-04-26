<?php

namespace App\Http\Requests\DeliveryType;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryTypeRequest extends FormRequest
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
            'title' => 'required|max:255|unique:delivery_types,title',
            'is_main' => 'boolean'
        ];
    }
}
