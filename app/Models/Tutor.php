<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $fillable = [
        'DNI',
        'name',
        'surname',
        'email',
        'number_phone',
        'is_active',

    ];

    public function students() {
        return $this->hasMany(Student::class);
    }
}
