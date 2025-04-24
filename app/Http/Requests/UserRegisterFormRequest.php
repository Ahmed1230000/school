<?php

namespace App\Http\Requests;

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
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')], // unique by id
            'password'              => ['required', 'string', 'min:4', 'max:8', 'confirmed'],
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'                  => 'Name is required',
            'name.string'                    => 'Name must be a string',
            'name.max'                       => 'Name must not exceed 255 characters',
            'email.required'                 => 'Email is required',
            'email.string'                   => 'Email must be a string',
            'email.email'                    => 'Email must be a valid email address',
            'email.max'                      => 'Email must not exceed 255 characters',
            'email.unique'                   => 'Email already exists',
            'password.required'              => 'Password is required',
            'password.string'                => 'Password must be a string',
            'password.min'                   => 'Password must be at least 4 characters',
            'password.max'                   => 'Password must not exceed 8 characters',
            'password.confirmed'             => 'Password confirmation does not match',
            'password_confirmation.required' => 'Password confirmation is required',
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
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        $data['password'] = bcrypt($data['password']);
        return $data;
    }
}
