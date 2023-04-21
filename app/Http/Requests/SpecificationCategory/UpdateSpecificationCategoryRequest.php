<?php

namespace App\Http\Requests\SpecificationCategory;

use App\Models\SpecificationCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateSpecificationCategoryRequest extends FormRequest
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
        $url = explode('/', $request->pathInfo);
        return [
            'title' => ['max:255',
                Rule::unique('color_categories')
                    ->ignore(SpecificationCategory::where('id', $url[3])->first()->id)
            ],
            'is_img' => 'boolean'
        ];
    }
}
