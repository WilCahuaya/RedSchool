<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Course extends Model
{
    use HasFactory;
    protected $table="student_course";
protected $fillable=[
    'students_id',
    'courses_id',
];

}
