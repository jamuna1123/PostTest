<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($userId)],
            'phone' => ['required', 'string', 'max:10'],
            'address' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
            'password' => ['nullable|min:8'], // Password is not required

        ];
    }
}
