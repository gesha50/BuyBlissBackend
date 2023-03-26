<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserEmailRequest extends FormRequest
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
            'phone' => [Rule::requiredIf($request->type_register === 'phone'),
                'regex:/^(7)[0-9]{10}$/',
                'unique:users,phone',
            ],
            'email' => [Rule::requiredIf($request->type_register === 'email'), 'unique:users,email'],
            'type_register' => 'required|string',
        ];
    }
}
