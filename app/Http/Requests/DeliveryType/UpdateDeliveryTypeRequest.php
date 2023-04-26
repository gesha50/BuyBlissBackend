<?php

namespace App\Http\Requests\DeliveryType;

use App\Models\DeliveryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateDeliveryTypeRequest extends FormRequest
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
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        return [
            'title' => ['max:255',
                Rule::unique('payment_types')
                    ->ignore(DeliveryType::where('id', $request->id)->first()->id)
            ],
            'is_main' => 'boolean'
        ];
    }
}
