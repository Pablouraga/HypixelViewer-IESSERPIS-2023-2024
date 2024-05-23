<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'subject' => ['required', 'string', 'max:50'],
            'text' => ['required', 'string', 'max:255'],
            'sender_email' => ['required', 'string', 'max:40', 'email'],
            // 'status' => ['required', 'enum:NotRead,Read'],
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'The subject is required.',
            'subject.string' => 'The subject has to be a string.',
            'subject.max' => 'The subject must be at most 50 characters.',
            'text.required' => 'The text is required.',
            'text.string' => 'The text has to be a string.',
            'text.max' => 'The text must be at most 255 characters.',
            'sender_email.required' => 'The sender email is required.',
            'sender_email.string' => 'The sender email has to be a string.',
            'sender_email.max' => 'The sender email must be at most 40 characters.',
            'sender_email.email' => 'The sender email must be a valid email address.',
            // 'status.required' => 'The status is required.',
            // 'status.enum' => 'The status must be one of the following: NotRead, Read.',
        ];
    }
}
