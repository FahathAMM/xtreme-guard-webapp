<?php

namespace App\Http\Requests\Product;

use App\Traits\failedValidationWithName;
use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'short_desc' => 'nullable|string',
            'category_id' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'tags' => 'nullable',
            'colors' => 'nullable',
            'main_image' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'slug' => 'nullable|string|unique:products,slug|max:255',
            'is_available' => 'nullable|boolean',
            'file_category' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png',

            // 'images.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            // 'images' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'The product name is required.',
    //         'slug.required' => 'The slug is required.',
    //         'slug.unique' => 'The slug must be unique.',
    //         'img.image' => 'The image must be a valid image file.',
    //         'is_active.boolean' => 'The is_active field must be true or false.',
    //     ];
    // }
}
