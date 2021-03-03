<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['id', 
    'nis', 
    'user_id', 
    'schoolclass_id', 
    'name', 
    'birthdate', 
    'gender', 
    'address', 
    'phone'];

    public function schoolclass()
    {
        return $this->belongsTo(Schoolclass::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function accumulations()
    {
        return $this->hasMany(Accumulation::class);
    }

    public function subjectcounts()
    {
        return $this->hasMany(Subjectcount::class);
    }
}
