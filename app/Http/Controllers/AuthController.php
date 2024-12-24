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

        $req = $request->all();
        if (isset($req['no1']) || isset($req['no2']) || isset($req['no3']) || isset($req['no4']) || isset($req['no5'])) {
            $array = [$req["no1"], $req["no2"], $req["no3"], $req["no4"], $req["no5"]];
            $otp = implode('', $array);

            $user = User::where(['email' => $req['email'], 'otp' => $otp])->first();
            if ($user) {
                Session::flash('email_temp', $user->email);
                return redirect('/set_password');
            } else {

                Session::flash('invalid', "OTP is not Correct");
                Session::flash('email', $req['email']);

                return view('forgotPassword', ['email' => $req['email'], 'no' => $array]);
            }
        } else {

            if (isset($req['email']) && !empty($req['email'])) {

                $user = User::where('email', $req['email'])->first();
                if ($user) {
                    $otp = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
                    $emailData = [
                        'otp' => $otp,
                        'name' => $user->name,
                        'body' => 'Thank you for choosing our services. We are pleased to provide you with the OTP verification.',
                    ];
                    $mail = new otpVerifcation($emailData);


                    try {
                        $user->reset_pswd_attempt = $user->reset_pswd_attempt ? ++$user->reset_pswd_attempt : 1;

                        if ($user->reset_pswd_attempt > 3) {
                            $resetTime = $user->reset_pswd_time ? Carbon::parse($user->reset_pswd_time) : null;
                            $currentTime = Carbon::now();

                            if (!$resetTime || $resetTime->addMinutes(5)->isPast()) {
                                $user->reset_pswd_attempt = 1;
                                $user->reset_pswd_time = $currentTime;
                            } else {
                                Session::forget(['status', 'message', 'otp']);
                                $remainingTime = $resetTime->diffInSeconds($currentTime);
                                return view('forgotPassword', ['email' => $req['email'], 'forgot_pass' => 'You have exceeded the maximum password reset attempts. Please try again after ', 'remainingTime' => $remainingTime]);
                            }
                        }

                        Mail::to($user->email)->send($mail);

                        $user->otp = $otp;
                        $user->reset_pswd_time = Carbon::now();
                        $user->save();

                        Session::flash('otp', "Email sent successfully!");
                        Session::flash('email', $user->email);

                        return view('forgotPassword', ['email' => $req['email']]);
                    } catch (\Exception $e) {
                        echo "Failed to send email: " . $e->getMessage();
                    }
                } else {

                    Session::flash('status', 'invalid');
                    Session::flash('message', 'this email is invalid');
                    Session::flash('email', $req['email']);


                    return view('forgotPassword', ['email' => $req['email']]);
                }
            } else {
                return view('forgotPassword');
            }
        }
    }

    public function set_password(Request $request)
    {
        $req['email'] = ($request->email) ? $request->email : session('email_temp');
        if ($req['email']) {
            if ($request->has('password')) {
                $validator = Validator::make($request->all(), [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                    'email' => 'required'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $user = User::where('email', $req['email'])->first();
                $user->password = Hash::make($request->password);
                $save = $user->save();

                if ($save) {
                    return redirect('/login')->with('password_changed', "Password is successfully changed");;
                }
            } else {
                return view('setPassword', ['email' => $req['email']]);
            }
        } else {
            return view('setPassword', ['email' => $req['email']]);
        }
    }

    public function verify(Request $request, $hash)
    {
        $user = User::where('remember_token', $hash)->first();

        if ($user) {
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
                $user->status = 1;
                $user->save();

                return redirect('/login')->with('success', 'Email verified successfully. Please log in.');
            } else {
                return redirect('/login')->with('success', 'Email already verified.');
            }
        } else {
            return redirect('/login')->with('error', 'Invalid verification link.');
        }
    }
}
