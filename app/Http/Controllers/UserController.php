<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome', [
            'titlePart' => '| Home',
            'user' => $request->session()->get('user', null)
        ]); 
    }

    public function login(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");

        $user = new User;
        $user = $user->checkUser($email, $password); // FIXA
        $request->session()->put('user', $user);

        if ($user) {
            return view('welcome', [
                'titlePart' => '| Home',
                'user' => $user
            ]); 
        }

        return redirect('/welcome');
    }

    public function registerForm(Request $request)
    {
        return view('register', [
            'titlePart' => '| Register',
        ]); 
    }

    public function register(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");
        $username = $request->input("username");

        $user = User::where('email', '=', $email)->first();

        if($user) {
            return abort(409, 'Email already taken.');
        }

        $newUser = new User;
        $newUser->email = $email;
        $newUser->password = bcrypt($password);
        $newUser->username = $username;
        $newUser->save();

        // auto log in
        $request->session()->put('user', $newUser);
        
        return redirect('/welcome');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        
        return redirect('/welcome');
    }
}
