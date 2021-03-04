<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    public function subjectmatter()
    {
        return $this->belongsTo(Subjectmatter::class);
    }

    public function schoolclass()
    {
        return $this->belongsTo(Schoolclass::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function quizquestions()
    {
        return $this->hasMany(Quizquestion::class);
    }
}
