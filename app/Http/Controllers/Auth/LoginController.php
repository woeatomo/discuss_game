<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'google2fa_token' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Validate Google2FA Token
            $google2fa = new Google2FA();
            $valid = $google2fa->verifyKey($user->google2fa_secret, $request->google2fa_token);

            if ($valid) {
                return redirect()->intended('dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['google2fa_token' => 'Invalid MFA token']);
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}