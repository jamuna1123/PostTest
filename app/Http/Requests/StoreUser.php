<?php

namespace App\Http\Requests;

use App\Models\User;
use Elegant\Sanitizer\Sanitizer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class StoreUser extends FormRequest
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

        // Determine if we are updating an existing user or creating a new one
        $userId = $this->route('user') ? $this->route('user') : null;
        $isUpdating = $userId !== null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($userId)],
            // 'phone' => ['required', 'string', 'max:10', Rule::unique(User::class)->ignore($userId)], // Unique phone number
            'phone' => ['required', 'numeric', 'digits:10'], // Ensuring phone is numeric and exactly 10 digits
            'address' => ['required', 'string', 'max:500'], // Limiting the address to 500 characters
            'status' => 'boolean',
            'image' => ['nullable', 'string'],

            // Password is required when creating, but optional on update
            'password' => [$isUpdating ? 'nullable' : 'required', Rules\Password::defaults()],
        ];

    }

    protected function prepareForValidation()
    {
        // Define sanitization rules
        $sanitizer = new Sanitizer($this->all(), [
            'name' => 'trim|escape',
        ]);

        // Replace request data with sanitized data
        $this->merge($sanitizer->sanitize());
    }
}
