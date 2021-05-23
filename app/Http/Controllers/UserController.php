<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Function to access the homepage /welcome.
     *
     * @var Request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('welcome', [
            'titlePart' => '| Home',
            'user' => $request->session()->get('user', null)
        ]);
    }

     /**
     * Function to log in the user.
     *
     * @var Request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");

        $user = new User();
        $userResponse = $user->checkUser($email, $password);

        if ($userResponse) {
            $request->session()->put('user', $userResponse);
            return redirect('/tasks');
        }

        return redirect('/welcome');
    }

     /**
     * Function access the register form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function registerForm()
    {
        return view('register', [
            'titlePart' => '| Register',
        ]);
    }

     /**
     * Function to register a new user.
     *
     * @var Request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

     /**
     * Function to log out a user.
     *
     * @var Request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $request->session()->forget('user');

        return redirect('/welcome');
    }
}
