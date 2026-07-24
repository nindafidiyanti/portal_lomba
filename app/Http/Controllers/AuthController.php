<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // =====================
    // 🔐 USER LOGIN
    // =====================
    public function showUserLogin()
    {
        return view('auth.login');
    }
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role === 'admin') {
                Auth::logout();
                return back()->with('error', 'Gunakan halaman login admin untuk akun administrator.');
            }

            $request->session()->regenerate();
            return redirect()->intended('/forum')->with('toast_success', 'Login berhasil!');
        }

        return back()->with('error', 'Password salah atau email belum terdaftar.');
    }
    // =====================
    // 👤 USER REGISTER
    // =====================
    public function showUserRegister()
    {
        return view('auth.daftar');
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        return redirect('/forum')->with('toast_success', 'Registrasi berhasil! Selamat datang di portal lomba.');
    }

    // =====================
    // 🔐 ADMIN LOGIN
    // =====================
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if ($request->username == 'admin' && $request->password == '123') {

            $user = User::where('email', 'admin@example.com')->first();

            if ($user && $user->role === 'admin') {
                Auth::login($user);
                return redirect()->route('admin.dashboard');
            }
        }

        // Login via database
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->with('error', 'Akun ini bukan admin.');
            }
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Password salah atau email belum terdaftar.');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->forget('is_admin');
        return redirect('/')->with('toast_success', 'Anda telah keluar dari akun. Sampai jumpa lagi!');
    }

    // ✏️ EDIT & UPDATE PROFIL
    public function editProfile()
    {
        $user = Auth::user();
        return view('setting', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profil')->with('toast_success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // Cek apakah password lama cocok
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.edit')->with('toast_success', 'Password berhasil diubah!');
    }
}