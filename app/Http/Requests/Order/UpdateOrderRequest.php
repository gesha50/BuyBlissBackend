<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'name' => '',
            'phone' => 'regex:/^(7)[0-9]{10}$/',
            'email' => 'email',
            'user_id' => 'exists:App\Models\User,id',
            'address_id' => 'exists:App\Models\Address,id',
            'delivery_type_id' => 'exists:App\Models\DeliveryType,id',
            'payment_type_id' => 'exists:App\Models\PaymentType,id',
            'status_id' => 'exists:App\Models\Status,id',
        ];
    }
}
