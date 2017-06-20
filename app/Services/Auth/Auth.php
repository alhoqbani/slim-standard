<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Mail\ResetPassword;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager;

class Auth
{
    
    /**
     * @var \Illuminate\Database\Capsule\Manager
     */
    private $db;
    
    /**
     * Auth constructor.
     */
    public function __construct(Manager $db)
    {
        $this->db = $db;
    }
    
    public function user()
    {
        if ($this->check()) {
            return User::find($_SESSION['user']);
        }
        
        return new User();
    }
    
    public function signIn(User $user)
    {
        $_SESSION['user'] = $user->id;
    }
    
    public function check()
    {
        return ! ! isset($_SESSION['user']);
    }
    
    public function attempt($email, $password)
    {
        if ( ! $user = User::where('email', $email)->first()) {
            return false;
        }
        
        if (password_verify($password, $user->password)) {
            
            $_SESSION['user'] = $user->id;
            
            return true;
        }
        
        return false;
    }
    
    public function logout()
    {
        unset($_SESSION['user']);
    }
    
    public function resetPassword($user)
    {
        $token = 'TOKEN';
        
        $this->db->table('password_resets')
            ->insert([
                'email'      => $user->email,
                'created_at' => Carbon::now()->toDateTimeString(),
                'token'      => $token,
            ]);
        
        return new ResetPassword($user, $token);
        
    }
}
