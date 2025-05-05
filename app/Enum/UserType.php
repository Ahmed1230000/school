<?php

namespace App\Enum;


enum UserType: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case TEACHER = 'teacher';
    case STUDENT = 'student';
}
