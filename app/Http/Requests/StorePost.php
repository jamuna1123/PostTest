<?php

namespace App\Http\Requests;

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
        return [
            'title' => 'required|unique:posts|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'post_category_id' => 'required|exists:post_categories,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'boolean',
        ];
    }
}
