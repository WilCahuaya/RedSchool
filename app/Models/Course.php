<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'teachers_id',
        'classrooms_id'
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
