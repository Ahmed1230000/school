<?php

namespace App\Http\Requests;

use App\Enum\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegisterFormRequest extends FormRequest
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
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')], // unique by id
            'password'  => ['required', 'string', 'min:4', 'max:8', 'confirmed'],
            'phone'     => ['nullable', 'string', 'max:11'],
            'address'   => ['nullable', 'string', 'max:100'],
            'title'     => ['nullable', 'string', 'max:100'],
        ];
    }
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'user_type' => UserType::STUDENT->value,
        ]);
    }

    /**
     * Get the validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'                  => 'Name is required.',
            'name.string'                    => 'Name must be a string.',
            'name.max'                       => 'Name must not exceed 255 characters.',

            'email.required'                 => 'Email is required.',
            'email.string'                   => 'Email must be a string.',
            'email.email'                    => 'Please enter a valid email address.',
            'email.max'                      => 'Email must not exceed 255 characters.',
            'email.unique'                   => 'This email is already registered.',

            'password.required'              => 'Password is required.',
            'password.string'                => 'Password must be a string.',
            'password.min'                   => 'Password must be at least 4 characters.',
            'password.max'                   => 'Password must not exceed 8 characters.',
            'password.confirmed'             => 'Password confirmation does not match.',

            // 'user_type.required'             => 'User type is required.',
            // 'user_type.string'               => 'User type must be a string.',
            // 'user_type.in'                   => 'Invalid user type selected.',

            'phone.string'                   => 'Phone must be a string.',
            'phone.max'                      => 'Phone must not exceed 11 characters.',

            'address.string'                 => 'Address must be a string.',
            'address.max'                    => 'Address must not exceed 100 characters.',

            'title.string'                   => 'Title must be a string.',
            'title.max'                      => 'Title must not exceed 100 characters.',

            'password_confirmation.required' => 'Password confirmation is required.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'                  => 'name',
            'email'                 => 'email',
            'password'              => 'password',
            'password_confirmation' => 'password confirmation',
        ];
    }
}
