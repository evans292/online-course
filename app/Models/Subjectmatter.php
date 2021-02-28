<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjectmatter extends Model
{
    use HasFactory;
    protected $fillable = ['course_id',
        'teacher_id',
        'title',
        'details',
        'path',
        'link'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function accumulations()
    {
        return $this->hasMany(Accumulation::class);
    }
}
