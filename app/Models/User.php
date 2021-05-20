<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public $email;
    public $password;
    public $username;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    public function checkUser($email, $pass)
    {
        $user = User::all()->filter()
            ->where('email', "=", $email)->first();

        if ($user != null && Hash::check($pass, $user->password)) {
            return $user;
        }

        return null;
    }

    public function hello()
    {
        return "hello";
    }
}
