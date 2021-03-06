<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'name', 'information'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function schoolclasses()
    {
        return $this->hasMany(Schoolclass::class);
    }

    public function teacher() 
    {
        return $this->belongsTo(Teacher::class);
    }
}
