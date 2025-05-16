<?php

namespace App\Rules;

use App\Models\Material;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IgnoreExistsMaterialsName implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $index = explode('.', $attribute)[1] ?? null;

        $teacherId = request()->route('teacher');

        $materialId = request()->input("materials.$index.id");

        $exists = Material::query()
            ->where('name', $value)
            ->where('teacher_id', $teacherId)
            ->where('id', '!=', $materialId ?? 0)
            ->exists();
        if ($exists) {
            $fail("The material name '$value' is already taken for this teacher.");
        }
    }
}
