<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
// use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function getEmail()
    {

        return view('auth.forgot_password.forgot_password');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|exists:users',
        ]);

        $token = str_random(60);

        // $email = $request->email;
        // return $email;

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.forgot_password.verify', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        return back()->with('message', 'We have e-mailed your password reset link!');

        // return $status === Password::RESET_LINK_SENT
        // ? back()->with(['status' => __($status)])
        // : back()->withErrors(['email' => __($status)]);


    }

    public function getPassword($token) {

        return view('auth.forgot_password.reset', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email:dns|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_resets')
                                    ->where(['email' => $request->email, 'token' => $request->token])
                                    ->first();

        if(!$updatePassword)
        return back()->withInput()->with('error', 'Invalid token!');

        if($request->has('password')) {
            $email = $request->email;
            $password = $request->password;
            $verify = $request->password_confirmation;

            if($password == $verify) {
                $user = User::where('email', $request->email)
                        ->update(['password' => Hash::make($request->password)]);

                DB::table('password_resets')->where(['email'=> $request->email])->delete();

                return redirect('/login')->with('message', 'Your password has been changed!');
            }


            return back()->with("message", "The credentials doesn't match!");



        }

    }

}
