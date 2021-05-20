<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * App\Models\Task
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $username
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

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
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function checkUser($email, $pass)
    {
        $user = User::all()->filter()
            ->where('email', "=", $email)->first();

        if ($user != null && Hash::check($pass, $user->password)) {
            return $user;
        }

        return null;
    }
}
