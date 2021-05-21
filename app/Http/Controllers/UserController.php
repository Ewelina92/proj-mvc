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

        $user = new User();
        $user = $user->checkUser($email, $password);

        if ($user) {
            $request->session()->put('user', $user);
            return redirect('/tasks');
        }

        return redirect('/welcome');
    }

    public function registerForm()
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

        /** @phpstan-ignore-next-line */
        $user = User::where('email', '=', $email)->first();

        if ($user) {
            abort(403, 'Email already taken.'); // return?
        }

        $newUser = new User();
        $newUser->email = $email;
        $newUser->password = bcrypt($password);
        $newUser->username = $username;
        $newUser->save();

        // auto log in
        $request->session()->put('user', $newUser);

        return redirect('/tasks');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');

        return redirect('/welcome');
    }
}
