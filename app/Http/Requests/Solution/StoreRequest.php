<?php

namespace App\Http\Requests\Solution;

use App\Traits\failedValidationWithName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    use failedValidationWithName;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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


            //old
            // 'title' => 'required|string|max:255',
            // 'slug' => 'nullable|string|max:255',
            // 'solution_type' => 'required|string|max:255',
            // // 'slug' => 'nullable|string|max:255|unique:solutions,slug,' . $this->id,
            // // 'banner_img' => 'nullable|string|max:255',
            // 'img_width' => 'nullable|string|max:10',
            // 'img_height' => 'nullable|string|max:10',
            // 'gallery' => 'nullable|string|max:255',
            // 'tags' => 'nullable',
            // 'file' => 'nullable|array',
            // 'content' => 'required|string',
            // 'desc' => 'nullable|string',
            // 'is_published' => 'boolean',
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'The category name is required.',
    //         'slug.required' => 'The slug is required.',
    //         'slug.unique' => 'The slug must be unique.',
    //         // 'img.image' => 'The image must be a valid image file.',
    //         'img1.dimensions' => 'The image size should be 300 x 300',
    //         'is_active.boolean' => 'The is_active field must be true or false.',
    //     ];
    // }
}
