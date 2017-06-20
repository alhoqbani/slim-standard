<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    protected $fillable = ['name', 'email', 'username', 'password'];
    
    protected $hidden = ['password', 'remember_token'];
    
    public static function findByEmail($email)
    {
        return static::where('email', $email)->first();
    }
    
    public static function findByToken($token)
    {
        return static::where('token', $token)->first();
    }
}