<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = ['id', 
    'user_id',
    'name', 
    'birthdate', 
    'gender', 
    'address', 
    'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
