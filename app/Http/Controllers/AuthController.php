<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function Login(Request $req)
    {
        $username = $req->input('username');
        $password = $req->input('password');

        if (Auth::attempt([
            'username' => $username,
            'password' => $password
        ])){
            $req->session()->regenerate();
            return redirect('/');
        }

        else {
            return redirect()->route('get_login')->withErrors([ 'login_failed' => 'Invalid username or password' ]);
        }
    }

    public function Register(Request $req)
    {
        $validator = Validator::make([
            "username" => $req->input('username'),
            "email" => $req->input('email'),
            "password" => $req->input('password'),
            "confirm_password" => $req->input('confirm_password'),
        ], [
            "username" => ['required', 'unique:App\Models\User,username', 'min:5'],
            "email" => ['required', 'email', 'unique:App\Models\User,email'],
            "password" => ['required', 'min:8'],
            "confirm_password" => ['same:password']
        ], [
            'username' => [
                'required' => 'Username must be filled',
                'unique' => 'Username already exists',
                'min' => 'Must be 5 characters or more'
            ],
            'email' => [
                'required' => 'Email must be filled',
                'email' => 'Must be a valid email',
                'unique' => 'Email has already been used'
            ],
            'password' => [
                'required' => 'Password must be filled',
                'min' => 'Must be 8 characters or more'
            ],
            'confirm_password' => [
                'same' => 'Must be equal to the password field'
            ]
        ]);

        if ($validator->fails())
        {
            return redirect()->route('get_register')->withErrors($validator)->withInput();
        }

        User::create([
            'username' => $req->input('username'),
            'email' => $req->input('email'),
            'password' => bcrypt($req->input('password'))
        ]);
        return redirect()->route('get_login')->with('register_success', 'Register success. Please login to the app');
    }

    public function Logout(Request $req) {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('get_login');
    }
}
