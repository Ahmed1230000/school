<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'class_rooms';

    protected $fillable = [
        'created_by',
        'name',
        'description',
        'code',
        'capacity',
        'floor',
        'building',
        'type',
        'status',
    ];

    protected $casts = [
        'created_by'  => 'integer',
        'name'        => 'string',
        'description' => 'string',
        'code'        => 'string',
        'capacity'    => 'integer',
        'floor'       => 'integer',
        'building'    => 'string',
        'type'        => 'string',
        'status'      => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'classroom_teacher', 'classroom_id', 'teacher_id')->withTimestamps();
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_student', 'classroom_id', 'student_id')->withTimestamps();
    }
}
