<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\User;

use function Laravel\Prompts\error;

class Authentication extends Controller
{
    //
    public function index(Request $request)
    {
        return view('Auth.login');
    }

    public function check_login(Request $request)
    {
        //check here the validate
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validate) {
            $user = User::where('email', $request->input('email'))->first();
            $username = $user-> username ?? '-';
            $user_email = $user->email ?? '-';
            if ($user && \Illuminate\Support\Facades\Hash::check($request->input('password'), $user->password)) {
                Session::put('user', $username);
                Session::put('use_email', $user_email);
                Session::put('login_success','login Success');
                return redirect()->route('dashboard');
            } else {
                Session::flash('login_failed', 'Invalid email or password');
                return redirect()->back()->with('message', 'Invalid email or password');
            }
        }
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validate) {
            $user_check = User::where('email', $request->input('email'))->orWhere('username', $request->input('username'))->first();
            if ($user_check) {
                Session::flash('message', 'Already User name and email exists');
                return view('Auth.register', compact('validate'))->with('message', 'Already User name and email exists');
            }
            $user = new User();
            $user->name = $request->input('fullname');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();
            //create a alert
            Session::flash('reg_success', 'User created successfully');
            return view('Auth.login')->with('message', 'Register Successfully');
        } else {
            return view('Auth.register')->with('message', 'Invalid input');
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect()->
        route('login');
        }

}
