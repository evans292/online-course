<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $dates = ['due'];
    protected $fillable = [
        'schoolclass_id',
        'subjectmatter_id',
        'teacher_id',
        'title',
        'instructions',
        'attachment',
        'point',
        'due',
        'status',
    ];

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
