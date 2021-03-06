<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $dates = ['due'];
    protected $fillable = [
        'schoolclass_id',
        'subjectmatter_id',
        'teacher_id',
        'admin_id',
        'title',
        'instructions',
        'point',
        'due',
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

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
