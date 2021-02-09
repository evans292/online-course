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
}
