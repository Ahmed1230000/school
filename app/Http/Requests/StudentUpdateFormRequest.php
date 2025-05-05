<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentUpdateFormRequest extends FormRequest
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
            'full_name'       => ['sometimes', 'string', 'max:255'],
            'date_of_birth'   => ['sometimes', 'date', 'before:today'],
            'gender'          => ['sometimes', 'in:male,female'],
            'grade'           => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'enrollment_date' => ['sometimes', 'date'],
            'address'         => ['sometimes', 'string', 'max:255'],
            'phone'           => ['sometimes', 'string', 'max:20', Rule::unique('students')->ignore($this->student)], // Ignore the current student's phone number
            'guardian_name'   => ['sometimes', 'string', 'max:255'],
            'guardian_phone'  => ['sometimes', 'string', 'max:20', Rule::unique('students')->ignore($this->student)], // Ignore the current student's guardian phone number

        ];
    }
}
