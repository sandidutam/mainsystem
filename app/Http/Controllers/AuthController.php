<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email:dns',
        //     'password' => 'required'
        // ]);

        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);


        $userlog = User::where('email', $request->email)->first();
        // $role = User::where('email', $request->email)->get('role');  -- GET THE FIELD ARRAY

        // GET THE FIELD VALUE
        $role = User::where('email', $request->email)->value('role');
        $id = User::where('email', $request->email)->value('id');


        // if (! $userlog || ! Hash::check($request->password, $userlog->password)) {
        //     throw ValidationException::withMessages([
        //         'email' => ['The provided credentials are incorrect.'],
        //     ]);
        // }

        $data_user = User::find($id);
        $data_user->last_login_at = Carbon::now()->toDateTimeString();
        $data_user->last_login_ip = $request->getClientIp();
        $data_user->update();

        // $token =  $userlog->createToken($request->email)->plainTextToken;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);



        // $loginDetails = $request->only('email','password');

        // if(Auth::attempt($loginDetails))
        //     {
        //         return redirect()->intended('/pegawai');
        //     } else {


        //         return redirect('/login')->with('message','Email atau Password salah!');
        //     }

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $id = $request->user()->id;
        $data_user = User::find($id);
        $data_user->last_login_at = null;
        $data_user->last_login_ip = null;
        $data_user->update();

        // return $id;
        Auth::logout();
        return redirect()->intended('/');
    }

}
