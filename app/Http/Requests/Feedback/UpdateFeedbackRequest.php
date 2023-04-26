<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedbackRequest extends FormRequest
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
            'stars' => 'required|numeric|between:0,5.0',
            'description' => '',
            'user_id' => 'exists:App\Models\User,id',
            'order_id' => 'exists:App\Models\Order,id',
            'product_id' => 'exists:App\Models\Product,id'
        ];
    }
}
