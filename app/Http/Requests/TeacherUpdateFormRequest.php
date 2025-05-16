<?php

namespace App\Http\Requests;

use App\Enum\StatusType;
use App\Rules\IgnoreExistsMaterialsName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherUpdateFormRequest extends FormRequest
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
            'date_of_birth'           => ['nullable', 'date', 'before:today'],
            'gender'                  => ['nullable', 'in:male,female'],
            'address'                 => ['nullable', 'string', 'max:255'],
            'phone'                   => ['nullable', Rule::unique('teachers', 'phone')->ignore($this->teacher), 'max:15'],
            'email'                   => ['nullable', 'email', 'max:255', Rule::unique('teachers')->ignore($this->teacher),],
            'subject'                 => ['nullable', 'string', 'max:255'],
            'hire_date'               => ['nullable', 'date', 'before_or_equal:today'],
            'qualification'           => ['nullable', 'string', 'max:255'],
            'experience'              => ['nullable', 'string', 'max:255'],
            'emergency_contact_name'  => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', Rule::unique('teachers', 'emergency_contact_phone')->ignore($this->teacher), 'max:15'],
            'status'                  => ['nullable', Rule::enum(StatusType::class)],
            'students'                => ['nullable', 'array'],
            'students.*'              => ['nullable', 'integer', Rule::exists('students', 'id')->whereNull('deleted_at')],
            'materials'               => ['nullable', 'array'],
            'materials.*.id'          => ['nullable', Rule::exists('materials', 'id')->whereNull('deleted_at')],
            'materials.*.description' => ['nullable', 'string', 'max:255'],
            'materials.*.name'        => ['string', new IgnoreExistsMaterialsName()]
        ];
    }
    public function messages(): array
    {
        return [
            'full_name.required'   => 'The full name is required.',
            'full_name.string'     => 'The full name must be a string.',
            'full_name.max'        => 'The full name cannot exceed 255 characters.',
            'date_of_birth.date'   => 'The date of birth must be a valid date.',
            'date_of_birth.before' => 'The date of birth must be before today.',
            'gender.in'            => 'The gender must be either male or female.',
            'phone.regex'          => 'The phone number format is invalid.',
            'email.email'          => 'The email address must be a valid email.',
            'email.unique'         => 'The email address is already taken.',
            'status.in'            => 'The status must be one of the following: pending, approved, rejected.',
        ];
    }
    public function attributes(): array
    {
        return [
            'full_name'     => 'Full Name',
            'date_of_birth' => 'Date of Birth',
            'gender' => 'Gender',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'subject' => 'Subject',
            'hire_date' => 'Hire Date',
            'qualification' => 'Qualification',
            'experience' => 'Experience',
            'emergency_contact_name' => 'Emergency Contact Name',
            'emergency_contact_phone' => 'Emergency Contact Phone',
            'status' => 'Status',
        ];
    }
}
