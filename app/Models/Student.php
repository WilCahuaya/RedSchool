<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'DNI',
        'name',
        'surname',
        'email',
        'number_phone',
        'is_active',
        'tutors_id',

    ];

    public function tutor(){
        return $this->belongsTo(Tutor::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }

    public function labors() {
        return $this->hasMany(Labors::class);
    }
}
