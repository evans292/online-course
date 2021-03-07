<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolclass extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'department_id', 'name', 'information'];

    public function teacher() 
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
