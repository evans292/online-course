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
    'kelas_id', 
    'name', 
    'birthdate', 
    'gender', 
    'address', 
    'phone'];
}
