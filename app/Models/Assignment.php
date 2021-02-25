<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $dates = ['due'];

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
}
