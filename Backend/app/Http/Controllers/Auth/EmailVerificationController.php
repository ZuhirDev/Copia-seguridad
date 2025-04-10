<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Tymon\JWTAuth\Facades\JWTAuth;

class EmailVerificationController extends Controller
{
/**
     * Enviar un nuevo enlace de verificación por correo.
     */
    // public function sendVerificationEmail(Request $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return response()->json([
    //             'message' => __('Your email is already verified.')
    //         ], 400);
    //     }

    //     $request->user()->sendEmailVerificationNotification();

    //     return response()->json([
    //         'message' => __('Verification link sent to your email.')
    //     ], 200);
    // }

    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => __('Your email is already verified.')
            ], 400);
        }

        // añadir verificacion por jwt token CAMBIAR RUTA DEL MAIL Y APUNTAR AL FRONTEND
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => JWTAuth::user()->id],
        );

        $request->user()->sendEmailVerificationNotification($url);

        return response()->json([
            'message' => __('Verification link sent to your email.')
        ], 200);
    }

    /**
     * Verificar el correo electrónico del usuario.
     */
    public function verifyEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => __('Your email is already verified.')
            ], 400);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json([
            'message' => __('Your email has been successfully verified.')
        ], 200);
    }
}
