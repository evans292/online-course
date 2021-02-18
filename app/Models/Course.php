<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function schoolclasses()
    {
        return $this->belongsToMany(Schoolclass::class);
    }

    public function subjectmatters()
    {
        return $this->hasMany(Subjectmatter::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
