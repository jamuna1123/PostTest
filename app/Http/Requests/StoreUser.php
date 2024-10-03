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
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns',  'max:255', Rule::unique(User::class)->ignore($userId)],            // 'phone' => ['required', 'string', 'max:10', Rule::unique(User::class)->ignore($userId)], // Unique phone number
            // Phone validation to allow +977, digits, and optional hyphens
            // Phone validation to allow +977 or 10 digits without the country code
            'phone' => [
                'required',
                'string',
                'regex:/^(\+977-?\d{2}-?\d{8}|\d{10})$/',  // Allow +977 or just 10 digits
                // Unique phone number
            ],
            'address' => ['required', 'string', 'max:255'], // Limiting the address to 500 characters
            'status' => 'boolean',
            'image' => ['nullable', 'string'],
 
            // Password is required when creating, but optional on update
            'password' => [$isUpdating ? 'nullable' : 'required', Rules\Password::defaults()],
        ];

    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number must be a valid number (+977 or 10 digits).',

        ];
    }

    

    protected function prepareForValidation()
    {
        // Define sanitization rules
        $sanitizer = new Sanitizer($this->all(), [
            'name' => 'trim|escape',
            'phone' => 'trim',  // Remove any unwanted characters and keep only digits

        ]);
        // Sanitize input
        $sanitizedData = $sanitizer->sanitize();

        // Check if the phone starts with +977 and remove it before storing
        if (str_starts_with($sanitizedData['phone'], '977')) {
            $sanitizedData['phone'] = substr($sanitizedData['phone'], 3);  // Remove '977' prefix
        }
        // Replace request data with sanitized data
        $this->merge($sanitizer->sanitize());
    }
}
