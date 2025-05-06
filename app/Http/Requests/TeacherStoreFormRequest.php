<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TeacherStoreFormRequest extends FormRequest
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
            'full_name'               => ['required', 'string', 'max:255'],
            'date_of_birth'           => ['required', 'date', 'before:today'],
            'gender'                  => ['required', 'in:male,female'],
            'address'                 => ['required', 'string', 'max:255'],
            'phone'                   => ['required', 'string', 'max:20', Rule::unique('teachers', 'phone')],
            'email'                   => ['required', 'email', 'max:255', Rule::unique('teachers', 'email')],
            'subject'                 => ['required', 'string', 'max:100'],
            'hire_date'               => ['required', 'date', 'before_or_equal:today'],
            'qualification'           => ['required', 'string', 'max:255'],
            'experience'              => ['required', 'string', 'max:255'],
            'emergency_contact_name'  => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'string', 'max:20', Rule::unique('teachers', 'emergency_contact_phone')],
        ];
    }
    public function messages(): array
    {
        return [
            'gender.in' => 'The gender must be either male or female.',
            'date_of_birth.before' => 'The date of birth must be before today.',
            'hire_date.before_or_equal' => 'The hire date must be today or earlier.',
            'phone.regex' => 'The phone format is invalid.',
            'emergency_contact_phone.regex' => 'The emergency contact phone format is invalid.',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        $data['user_id'] = Auth::id();
        return $data;
    }
}
