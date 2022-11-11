<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    use HasFactory;
    protected $fillable=[
        'photo',
        'reception_code',
        'note',
        'feedback',
        'delivery_date',
        'students_id',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
