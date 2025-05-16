<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'teachers';
    protected $fillable = [
        'full_name',
        'date_of_birth',
        'gender',
        'address',
        'phone',
        'email',
        'subject',
        'hire_date',
        'qualification',
        'experience',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_teacher', 'teacher_id', 'student_id')->withTimestamps();
    }
    public function classrooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'classroom_teacher', 'teacher_id', 'classroom_id')->withTimestamps();
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
