<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            if(!Hash::check($request->password,$user->password))
            {
                return response()->json([
                    'status'=> 401,
                    'message'=> 'Maaf, Password Anda salah Silahkan coba lagi',
                ]);
            }
        }

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        Auth::attempt($data);

        if(Auth::check())
        {
            $user = Auth::user();
            $user->access_token = $user->createToken('upt-museum')->plainTextToken;

            return response()->json([
                'status'=> 200,
                'message'=> 'Berhasil Login',
                'user'=> $user,
            ]);
        }
        else
        {
            // return $this->jsonResponse(401,"Anda Belum Terdaftar");
            return response()->json([
                'status'=> 401,
                'message'=> 'Anda Belum Terdaftar',
            ]);
        }

    }

    public function me(){
        $user = User::where('id' , Auth::id())->first();
        $user->getRoleNames();

        // return $this->JsonResponse(200, 'Data user sukses didapat', $user);
        return response()->json([
            'status' => 200,
            'user' => $user,
            // 'token' => "masuk",
        ]);
    }
}
