<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'students';
    protected $fillable = [
        'full_name',
        'date_of_birth',
        'gender',
        'grade',
        'enrollment_date',
        'address',
        'phone',
        'guardian_name',
        'guardian_phone',
        'user_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'enrollment_date' => 'date',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_teacher', 'student_id', 'teacher_id')->withTimestamps();
    }

    public function classrooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'classroom_student', 'student_id', 'classroom_id')->withTimestamps();
    }
}
