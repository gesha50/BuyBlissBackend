<?php

namespace App\Http\Requests\ColorCategory;

use App\Models\ColorCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateColorCategoryRequest extends FormRequest
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
        $url = explode('/', $request->pathInfo);
        return [
            'title' => ['max:255',
                Rule::unique('color_categories')
                    ->ignore(ColorCategory::where('id', $url[3])->first()->id)
            ],
            'is_img' => 'boolean'
        ];
    }
}
