<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'DNI',
        'name',
        'surname',
        'email',
        'number_phone',
        'specialization',
        'is_active',

    ];

    public function courses(){
        return $this->hasMany(Course::class);
    }
}
