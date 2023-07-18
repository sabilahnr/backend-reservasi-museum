<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use GuzzleHttp\Client as CLIENGUZ;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\ApiException;
use Illuminate\Support\Str;


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
        
        if($user->status === 0)
        {
            return response()->json([
                'status'=> 401,
                'message'=> 'Maaf, Akun anda tidak aktif',
            ]);
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
                'token' => Auth::id(),
        ]);


    }
    public function show(){
        
        $user = User::where('id' , Auth::id())->first();
        $user->getRoleNames();

        // return $this->JsonResponse(200, 'Data user sukses didapat', $user);
        return response()->json([
                'status' => 200,
                'user' => $user,
                'token' => Auth::id(),
        ]);


    }



    public function show_admin()
    {
        $admin =   User::with('roles')->get();
        // $admin =   !Hash::check('password')

        return response()->json([
            'status'=> 200,
            'admin'=>$admin,
        ]);
    }

    public function register(Request $request)
    {

        $rawPassword = Str::random(8); // Generate password acak

        $hashedPassword = Hash::make($rawPassword); // Hash password sebelum menyimpannya

        

            $user = new User();
            $user->name = ucwords(strtolower($request->nama));
            $user->email = strtolower($request->email);
            
            $user->password = $hashedPassword;
            $user->status = '1';
            $save = $user->save();
            $user->syncRoles('admin');

        if($save)
        {
            $apiKey = $_ENV['SENDINBLUE_API_KEY'];

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
        $apiInstance = new TransactionalEmailsApi(new CLIENGUZ(), $config);

        $to = [
            [
                'email' => $request->input('email'),
                'name' => $request->input('nama'),
            ]
        ];

        $sendSmtpEmail = new SendSmtpEmail();
        $sendSmtpEmail->setTo($to);
        $sendSmtpEmail->setSender(new SendSmtpEmailSender(["name" => "UPTD Museum Surakarta", "email" => "samuelsteven@student.uns.ac.id"]));
        $sendSmtpEmail->setSubject("Berhasil Menambahkan Admin Baru");
        $sendSmtpEmail->setHtmlContent("
            Hallo, {$request->input('nama')}!<br><br>
            Anda menjadi admin UPTD Museum! <br><br>
            Informasi lengkap:<br>
                Nama = {$request->input('nama')} <br>
                Email = {$request->input('email')} <br>
                Password = {$rawPassword} <br>
            Jika Anda memiliki pertanyaan atau membutuhkan bantuan, bisa menghubungi tim IT .<br><br>
            UPT Museum Surakarta
        ");

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        }catch (ApiException $e) {
            // Penanganan kesalahan jika gagal mengirim email
            return response()->json([
                'status' => 'gagal',
                'message' => $e->getMessage()
            ]);
        }


            return response()->json([
                'status' => 200,
                'message' => "Berhasil Menambahkan Admin",
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

    public function update_admin($id_admin)
    {
        $admin = User::find($id_admin);
        if($admin)
        {
            $admin->status = $admin->status == 1 ? 0 : 1;
            $admin->save();

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

    public function changePassword(Request $request)
{
    $user = Auth::user();
    $currentPassword = $request->input('current_password');
    $newPassword = $request->input('new_password');

    // Periksa kecocokan password saat ini
    if ($currentPassword !== $user->password) {
        return response()->json([
            'status' => 401,
            'message' => 'Password anda belum berubah',
        ]);
    }

    // Periksa kecocokan password saat ini
    if (!Hash::check($currentPassword, $user->password)) {
        return response()->json([
            'status' => 401,
            'message' => 'Password saat ini tidak cocok',
        ]);
    }

    // Validasi password baru
    $validator = Validator::make($request->all(), [
        'new_password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'message' => 'Password baru tidak valid',
            'errors' => $validator->errors(),
        ]);
    }

    // Ubah password pengguna
    $user->password = Hash::make($newPassword);
    $user->save();

    return response()->json([
        'status' => 200,
        'message' => 'Password berhasil diubah',
    ]);
}







}
