<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'index' => 'required | integer',
            'region' => 'string',
            'city' => 'string',
            'street' => 'required | string',
            'house' => 'required | string',
            'floor' => 'integer',
            'entrance' => 'integer',
            'flat' => 'integer',
            'is_private_house' => 'required | boolean',
            'is_main' => 'required | boolean',
            'user_id' => 'required | exists:App\Models\User,id'
        ];
    }
}
