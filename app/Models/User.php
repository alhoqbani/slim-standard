<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    protected $fillable = ['name', 'email', 'username', 'password'];
    
    protected $hidden = ['password', 'remember_token'];
    
    public $timestamps = false;
}