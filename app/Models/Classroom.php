<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade',
        'section',
        'is_active',
    ];

    public function courses(){
        return $this->hasMany(Course::class);
    }
}
