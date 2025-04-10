<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Facades\JWTAuth;
class PasswordResetController extends Controller
{
    public function updatePassword(UpdatePasswordRequest $request)
    {
        // dd($request);
        $user = JWTAuth::user();

        if(!Hash::check($request->current_password, $user->password)){
            return response()->json([
                'message' => __('The current password is incorrect.'),
            ], 400);
        }

        if ($request->current_password === $request->password) {
            return response()->json([
                'message' => __('The new password cannot be the same as the current password.'),
            ], 400);
        }

        $user->update([
            "password" => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => __('Password updated successfully.'),
        ], 200);
    }

    /**
     * Send password reset link to the given email address.
     */
    public function sendResetLink(ForgotPasswordRequest $request)
    {
        // dd($request);
        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return response()->json(['message' => __('passwords.sent')], 200);
        }

        return response()->json(['message' => 'There was an error sending the password reset link.'], 400);
    }

    /**
     * Reset the password for the given email and token.
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => __('passwords.reset')], 200);
        }

        return response()->json(['message' => 'There was an issue resetting the password.'], 400);
    }
}
