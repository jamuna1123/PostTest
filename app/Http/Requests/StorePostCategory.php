<?php

namespace App\Http\Requests;

use Elegant\Sanitizer\Sanitizer;
use Illuminate\Foundation\Http\FormRequest;

class StorePostCategory extends FormRequest
{
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
        $categoryId = $this->route('post_category'); // Assuming 'post_category' is passed as a route parameter

        return [
            'title' => 'required|max:255|unique:post_categories,title,'.$categoryId, // Allowing the current category's title
            'image' => 'nullable|string', // Image is optional
            'description' => 'required|string',
            'status' => 'boolean',
        ];

    }

    protected function prepareForValidation()
    {
        // Define sanitization rules
        $sanitizer = new Sanitizer($this->all(), [
            'title' => 'trim|escape',
            // 'description' => 'trim|escape',

            'slug' => 'trim|escape',
        ]);

        // Replace request data with sanitized data
        $this->merge($sanitizer->sanitize());
    }
}
