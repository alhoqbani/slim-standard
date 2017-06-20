<?php

namespace App\Services\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager;

class Auth
{
    
    /**
     * Reset Password token validation in Hours
     */
    const TOKEN_VALID_FOR = 1;
    /**
     * @var \Illuminate\Database\Capsule\Manager
     */
    private $db;
    
    /**
     * Auth constructor.
     *
     * @param \Illuminate\Database\Capsule\Manager $db
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
    
    public function passwordToken($user)
    {
        $token = $this->generateToken();
        
        $this->db->table('password_resets')
            ->insert([
                'email'      => $user->email,
                'created_at' => Carbon::now()->toDateTimeString(),
                'token'      => $token,
            ]);
        
        return $token;
    }
    
    public function validateToken($token)
    {
        if ($validToken = $this->verifyToken($token)) {
            return $validToken->email;
        } else {
            return false;
        }
    }
    
    public function resetPassword(User $user, $password)
    {
        $user->update([
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        $this->db->table('password_resets')->where('email', $user->email)->delete();
    }
    
    
    protected function generateToken($length = 32)
    {
        if ( ! isset($length) || intval($length) <= 8) {
            $length = 32;
        }
        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes($length));
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }
    
    private function verifyToken($token)
    {
        $token = $this->db->table('password_resets')->where('token', $token)->first();
        
        return ($token && $this->tokenIsRecent($token)) ? $token : false;
    }
    
    private function tokenIsRecent($token)
    {
        return Carbon::parse($token->created_at)->diffInHours() < self::TOKEN_VALID_FOR;
    }
}
