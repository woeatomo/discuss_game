<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PragmaRX\Google2FA\Google2FA;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate Google2FA Secret
        $google2fa = new Google2FA();
        $user->google2fa_secret = $google2fa->generateSecretKey();
        $user->save();

        // Generate QR Code
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        return view('auth.google2fa', ['qr_image' => $QR_Image, 'secret' => $user->google2fa_secret]);
    }
}