<?php

namespace App\Http\Requests;

use Elegant\Sanitizer\Sanitizer;
use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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

        $postId = $this->route('post'); // Assuming 'post' is passed as a route parameter

        return [
            'title' => 'required|max:255|unique:posts,title,'.$postId,
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
            'description' => 'required|string',
            'post_category_id' => 'required|exists:post_categories,id',
            'user_id' => 'required|exists:users,id',
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
