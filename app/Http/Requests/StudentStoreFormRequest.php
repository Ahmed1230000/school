<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentStoreFormRequest extends FormRequest
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
            'full_name'       => ['required', 'string', 'max:255'],
            'date_of_birth'   => ['required', 'date', 'before:today'],
            'gender'          => ['required', 'in:male,female'],
            'grade'           => ['required', 'numeric', 'min:0', 'max:100'],
            'enrollment_date' => ['required', 'date'],
            'address'         => ['required', 'string', 'max:255'],
            'phone'           => ['required', 'string', 'max:20', Rule::unique('students', 'phone')],
            'guardian_name'   => ['required', 'string', 'max:255'],
            'guardian_phone'  => ['required', 'string', 'max:20', Rule::unique('students', 'guardian_phone')],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $date = parent::validated();
        $date['user_id'] = Auth::id();
        return $date;
    }
}
