<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;

class RequestUserPassword extends FormRequest
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
            // Validate current_password only if it's provided, and ensure it matches the user's existing password
            'current_password' => ['sometimes', 'required', function ($attribute, $value, $fail) {
                if (! Hash::check($value, $this->user()->password)) {
                    $fail('The current password is incorrect.');
                }
            }],

            // Require new_password with specific rules
            'new_password' => ['required', 'string', 'min:8', PasswordRule::defaults()],

            // Require confirm_password if new_password is present and ensure they match
            'confirm_password' => ['same:new_password'],
        ];
    }
}
