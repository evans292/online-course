<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['id', 
    'user_id',
    'nip', 
    'name', 
    'birthdate', 
    'gender', 
    'address', 
    'phone'];

    public function schoolclass()
    {
        return $this->hasOne(Schoolclass::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schoolclasses()
    {
        return $this->belongsToMany(Schoolclass::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
