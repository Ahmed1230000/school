<?php

namespace App\Http\Requests;

use App\Enum\ClassStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClassRoomStoreFormRequest extends FormRequest
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
            'code'        => ['required', 'string', 'max:50', Rule::unique('class_rooms', 'code')],
            'capacity'    => ['required', 'integer', 'min:1', 'max:30'],
            'floor'       => ['required', 'integer', 'min:0', 'max:10'],
            'building'    => ['required', 'string', 'max:100'],
            'type'        => ['required', 'string', 'max:50'],
            'status'      => ['required', Rule::enum(ClassStatus::class)],
            'teachers'    => ['nullable', 'array'],
            'teachers.*'  => ['integer', 'exists:teachers,id'],
            'students'    => ['nullable', 'array'],
            'students.*'  => ['exists:students,id'],
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
            'capacity.required'    => 'The capacity field is required.',
            'capacity.integer'     => 'The capacity must be an integer.',
            'capacity.min'         => 'The capacity must be at least 1.',
            'capacity.max'         => 'The capacity may not be greater than 30.',
            'floor.required'       => 'The floor field is required.',
            'floor.integer'        => 'The floor must be an integer.',
            'floor.min'            => 'The floor must be at least 0.',
            'floor.max'            => 'The floor may not be greater than 10.',
            'building.required'    => 'The building field is required.',
            'building.string'      => 'The building must be a string.',
            'building.max'         => 'The building may not be greater than 100 characters.',
            'type.required'        => 'The type field is required.',
            'type.string'          => 'The type must be a string.',
            'type.max'             => 'The type may not be greater than 50 characters.',

            // Add more custom messages as needed
        ];
    }
    public function attributes(): array
    {
        return [
            'name'        => 'name',
            'description' => 'description',
            'code'        => 'code',
            'capacity'    => 'capacity',
            'floor'       => 'floor',
            'building'    => 'building',
            'type'        => 'type',
            'status'      => 'status',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'created_by' => Auth::id(),
        ]);
    }
}
