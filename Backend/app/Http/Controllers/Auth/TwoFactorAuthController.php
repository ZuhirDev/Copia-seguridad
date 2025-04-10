<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Google2FA;
use Tymon\JWTAuth\Facades\JWTAuth;

class TwoFactorAuthController extends Controller
{
    protected $google2fa;

    public function __construct(Google2FA $google2fa)
    {
        $this->google2fa = $google2fa;
    }

    public function enable2FA(Request $request)
    {
        $user = Auth::user();

        if($user->google2fa_secret){
            return response()->json(['message' => "2FA ya está habilitado"]);
        }

        $secretKey  = $this->google2fa->generateSecretKey();


        User::find($user->id)->update([
            'google2fa_secret' => $secretKey,
        ]);

        $qrCodeURL = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secretKey,
        );

        return response()->json([
            'secret' => $secretKey,
            'qr_url' => $qrCodeURL,
        ]); 
    }



    public function verify2FA(Request $request)
    {

        // dd($request->one_time_password);
        $request->validate([
            'one_time_password' => 'required|numeric|digits:6',
        ]);
        
        $user = Auth::user();

        JWTAuth::invalidate(JWTAuth::getToken());
        

        if(!$user->google2fa_secret) return response()->json(["message" => 'No está habilitado 2FA']);

        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

        if(!$valid) return response()->json(['message' => 'Código inválido.'], 400);

        User::find($user->id)->update([
            'google2fa_enabled' => true,
        ]);

        $newToken = JWTAuth::fromUser($user);  // mirar metodos en web

        return response()->json([
            'message' => '2FA habilitado con éxito',
            'token' => $newToken,
            'user' => $user,
        ]);
    }

    public function disable2FA(Request $request)
    {
        $user = Auth::user();

        if(!$user->google2fa_secret) return response()->json(["message" => '2FA ya esta deshabilitado']);

        User::find($user->id)->update([
            'google2fa_secret' => null,
            'google2fa_enabled' => false,
        ]);

        return response()->json(['message' => "2FA deshabilitado correctamente"]);
    }
}
