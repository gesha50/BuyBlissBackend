<?php

namespace App\Http\Requests\Specification;

use App\Models\Specification;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateSpecificationRequest extends FormRequest
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
            'title' => ['max:255',
                Rule::unique('specifications')
                    ->ignore(Specification::where('id', $request->id)->first()->id)
            ],
            'type' => '',
            'is_filter' => 'boolean | required',
            'specification_category_id' => 'exists:App\Models\SpecificationCategory,id'
        ];
    }
}
