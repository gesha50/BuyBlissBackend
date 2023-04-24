<?php

namespace App\Http\Requests\SpecificationValue;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecificationValueRequest extends FormRequest
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
            'value' => 'required',
            'description' => '',
            'img' => 'image',
            'specification_id' => 'exists:App\Models\Specification,id'

        ];
    }
}
