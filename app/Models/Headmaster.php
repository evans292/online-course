<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headmaster extends Model
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
}
