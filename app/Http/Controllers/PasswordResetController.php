<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class PasswordResetController extends Controller
{
    // Halaman form lupa password
    public function showForgotForm()
    {
        return view('auth.forgotpassword');
    }

    // Kirim link reset ke email
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak terdaftar di sistem kami.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('toast_success', 'Link reset password telah dikirim ke email kamu!');
        }

        return back()->with('toast_error', 'Gagal mengirim email. Coba lagi.');
    }

    // Halaman form reset password (dari link email)
    public function showResetForm(Request $request, string $token)
    {
        return view('auth.resetpassword', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 6 karakter.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login.user')
                ->with('toast_success', 'Password berhasil direset! Silakan login.');
        }

        return back()->with('toast_error', 'Token tidak valid atau sudah kedaluwarsa.');
    }
}