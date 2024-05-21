<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditAccountRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:25', Rule::unique('users')->ignore($this->user()->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'linked_account' => ['nullable', 'string', 'max:16', Rule::unique('users')->ignore($this->user()->id)],
        ];
    }
    public function messages(): array
    {
        return [
            'username.required' => 'The username is required.',
            'username.string' => 'The username has to be a string.',
            'username.max' => 'The username must be at most 25 characters.',
            'username.unique' => 'The username is already taken.',
            'password.string' => 'The new password has to be a string.',
            'password.min' => 'The new password must be at least 8 characters.',
            'password.confirmed' => 'The new password confirmation does not match.',
            'linked_account.max' => 'The linked account must be at most 16 characters.',
            'linked_account.unique' => 'The linked account is already taken.',
        ];
    }
}
