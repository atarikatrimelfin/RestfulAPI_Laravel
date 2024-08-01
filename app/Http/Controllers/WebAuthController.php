<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    public function register()
    {
        return view('register');
    }


    public function registered(Request $request)
    {
        $existingUser = User::where('email', $request->email)
        ->where('name', $request->name)->exists();;
        if ($existingUser) {
            return redirect()->back()->withInput()->withErrors(['email' => 'User Already Registered.']);
        }

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/')->with('success', 'User Successfuly Regiatered');
    }
    public function login(){
        return view('login');
    }
    public function ceklogin(Request $request){
        if(
            !Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])
        ){
            return redirect('/')->with('error', 'Email atau password salah.');
        } else {
            return redirect ('/home');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
