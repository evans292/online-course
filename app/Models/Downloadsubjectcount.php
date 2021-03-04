<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downloadsubjectcount extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'subjectmatter_id', 'downloads'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function subjectmatter()
    {
        return $this->belongsTo(Subjectmatter::class);
    }
}
