<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            $user->getRoleNames();
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

    public function show_admin()
    {
        $admin =   User::role('admin')->get();
        // $admin =   !Hash::check('password')

        return response()->json([
            'status'=> 200,
            'admin'=>$admin,
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = ucwords(strtolower($request->nama));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $save = $user->save();
        $user->syncRoles('admin');

        if($save)
        {
            return response()->json([
                'status' => 200,
                'message' => "Berhasil bang",
            ]);
        }else
        {
            return response()->json([
                'status' => 400,
                'message' => "gagal bang",
            ]);
        }



    }

    public function destroy($id_admin)
    {
        $admin = User::find($id_admin);
        if($admin)
        {
            $admin->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Berhasil Delete admin',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Admin ID Found',
            ]);
        }
    }
}
