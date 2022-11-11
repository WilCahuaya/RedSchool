<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'reception_code',
        'name',
        'description',
        'created_date',
        'delivery_date',
        'photo',
        'courses_id',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
