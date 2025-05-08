<?php

namespace App\Http\Requests;

use App\Enum\ClassStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassRoomUpdateFormRequest extends FormRequest
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
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'code'        => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('class_rooms', 'code')->ignore($this->route('classroom')),
            ],
            'capacity'    => ['nullable', 'integer', 'min:1', 'max:30'],
            'floor'       => ['nullable', 'integer', 'min:0', 'max:10'],
            'building'    => ['nullable', 'string', 'max:100'],
            'type'        => ['nullable', 'string', 'max:50'],
            'status'      => ['nullable', Rule::enum(ClassStatus::class)],
            'teachers'    => ['nullable', 'array'],
            'teachers.*'  => ['nullable', 'integer', Rule::exists('teachers', 'id')->whereNull('deleted_at')],
            'students'    => ['nullable', 'array'],
            'students.*'  => ['nullable', 'integer', Rule::exists('students', 'id')->whereNull('deleted_at')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'The name field is required.',
            'name.string'          => 'The name must be a string.',
            'name.max'             => 'The name may not be greater than 100 characters.',
            'description.string'   => 'The description must be a string.',
            'code.required'        => 'The code field is required.',
            'code.string'          => 'The code must be a string.',
            'code.max'             => 'The code may not be greater than 50 characters.',
            'code.unique'          => 'The code has already been taken.',
            'capacity.integer'     => 'The capacity must be an integer.',
            'capacity.min'         => 'The capacity must be at least 1.',
            'capacity.max'         => 'The capacity may not be greater than 30.',
            'floor.integer'        => 'The floor must be an integer.',
            'floor.min'            => 'The floor must be at least 0.',
            'floor.max'            => 'The floor may not be greater than 10.',
            'building.string'      => 'The building must be a string.',
            'building.max'         => 'The building may not be greater than 100 characters.',
            'type.string'          => 'The type must be a string.',
            'type.max'             => 'The type may not be greater than 50 characters.',
        ];
    }
}
