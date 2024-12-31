<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.auth.login');
    }

    public function login(Request $request)
    {

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if (in_array($user->status, auth_users())) {
                if (Auth::attempt($credentials)) {
                    auth()->login($user);
                    return redirect()->intended('/');
                } else {
                    return redirect()->back()->with('error', 'Invalid Credentials, Contact Admin')->withInput();
                }
            } else if ($user->status == 4) {
                return redirect()->back()->with('error', 'User is unverified, Please Check Your Email')->withInput();
            } else {
                return redirect()->back()->with('error', 'You are Unauthorized to Login')->withInput();
            }
        } else {
            return redirect()->back()->with('error', 'User does not exist')->withInput();
        }
    }

    public function logout(REQUEST $request)
    {
        session()->forget('lang');
        session()->flush();
        return redirect()->route('login');
    }

    public function forgot_password(REQUEST $request)
    {
        
        return view('pages.auth.password');
    }

    public function change_password(Request $request)
    { 
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'new_password' => 'required|min:6|confirmed',
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->with('error', 'Email not found.');
            }

            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('login')->with('success', 'Password changed successfully.');

    }
}
