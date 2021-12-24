<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class apiAuthController extends Controller
{
    public function teslogin(Request $request)
    {
        return response()->json(
            "Ahay",
        );
    }

    public function login(Request $request)
    {
        // return response()->json(
        //     "Ahay",
        // );

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $userlog = User::where('email', $request->email)->first();
        // $role = User::where('email', $request->email)->get('role');  -- GET THE FIELD ARRAY

        // GET THE FIELD VALUE
        $role = User::where('email', $request->email)->value('role');

        $allUser = User::all();

        if (! $userlog || ! Hash::check($request->password, $userlog->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token =  $userlog->createToken($request->device_name)->plainTextToken;
        $device = $request->device_name;
        $response = [

                'user' => $userlog,
                'token' => $token,
                'role' => $role,
                'device_name' => $device,
                'all_user' => $allUser

        ];
        $resrole = [
            'role' => $role
        ];

        return response($response, 201);
    }

    public function dummy(Request $request)
    {
        $allUser = User::all();
        $user = User::where('email', 'sandiduta@gmail.com')->first();

        $response =
            [
                'user' => $allUser
            ];



        return response()->json($user);
        // return response()->json($allUser);
        // return response($response);
    }

    public function pegawai(Request $request)
    {
        $id = $request->data;

        // return response()->json($id);
        $allUser = User::all();
        $user = User::where('email', 'sandiduta@gmail.com')->first();
        $nomor_pegawai = Pegawai::select('nomor_pegawai')->where('id', '=', $id)->pluck('nomor_pegawai')->first();
        $nama_depan = Pegawai::select('nama_depan')->where('id', '=', $id)->pluck('nama_depan')->first();
        $nama_belakang = Pegawai::select('nama_belakang')->where('id', '=', $id)->pluck('nama_belakang')->first();
        $jabatan = Pegawai::select('jabatan')->where('id', '=', $id)->pluck('jabatan')->first();
        $sektor_area = Pegawai::select('sektor_area')->where('id', '=', $id)->pluck('sektor_area')->first();
        $status = Pegawai::select('status')->where('id', '=', $id)->pluck('status')->first();

        $response =
            [
                'nomor_pegawai' => $nomor_pegawai,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'nama_lengkap' => $nama_depan." ".$nama_belakang,
                'jabatan' => $jabatan,
                'sektor' => $sektor_area,
                'status' => $status,
            ];

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response('Loggedout', 200);
    }
}
