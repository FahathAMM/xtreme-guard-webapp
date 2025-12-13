<?php

namespace App\Http\Requests\Solution;

use Illuminate\Validation\Rule;
use App\Traits\failedValidationWithName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    use failedValidationWithName;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'solution_type' => 'required|string|max:255',
            // 'slug' => 'nullable|string|max:255|unique:solutions,slug,' . $this->id,
            // 'banner_img' => 'nullable|string|max:255',
            'img_width' => 'nullable|string|max:10',
            'img_height' => 'nullable|string|max:10',
            'gallery' => 'nullable|string|max:255',
            'tags' => 'nullable',
            'file' => 'nullable|array',
            'content' => 'nullable|string',
            'desc' => 'nullable|string',
            'is_published' => 'boolean',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'The category name is required.',
    //         'slug.required' => 'The slug is required.',
    //         'slug.unique' => 'The slug must be unique.',
    //         'img.image' => 'The image must be a valid image file.',
    //         'is_active.boolean' => 'The is_active field must be true or false.',
    //     ];
    // }
}
