<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // arahkan ke view register
    }

    public function register(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8', // `confirmed` untuk validasi confirm_password
        ]);

        // Buat user baru
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Enkripsi password
        $user->role = 'customer'; // Atur peran default
        $user->save(); // Simpan user ke database

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('loginForm')->with('status', 'Registrasi berhasil. Silakan masuk.');
    }

    public function showLoginForm()
    {
        return view('auth.login'); // arahkan ke view login
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('username', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/admin/profile'); // sesuaikan dengan tujuan
    //     }

    //     // return back()->withErrors([
    //     //     'email' => 'Email atau password salah.',
    //     // ])->onlyInput('email');

    //     return back()->withErrors([
    //         'username' => 'Nama atau password salah.',
    //     ])->onlyInput('username');
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/profile'); // sesuaikan dengan tujuan
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // arahkan ke halaman login setelah logout
    }

    public function profile()
    {
        $user = Auth::user(); // ambil data user yang sedang login
        if (!$user) {
            return redirect()->route('login'); // jika tidak ada user yang login, arahkan ke halaman login
        }
        // Anda bisa mengirimkan data user ke view jika diperlukan
        return view('auth.profile', compact('user')); // arahkan ke view profile
    }

    public function changePassword()
    {
        $user = Auth::user(); // ambil data user yang sedang login
        if (!$user) {
            return redirect()->route('login'); // jika tidak ada user yang login, arahkan ke halaman login
        }
        return view('auth.change-password', compact('user')); // arahkan ke view ubah password
    }
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // `confirmed` untuk validasi confirm_password
        ]);

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Cek apakah password lama yang dimasukkan sesuai dengan password yang tersimpan
        if (!password_verify($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        // Update password jika valid
        $user->password = bcrypt($request->new_password);  // Menggunakan bcrypt untuk enkripsi password baru
        $user->save();  // Simpan perubahan password

        // Redirect dengan pesan sukses
        return redirect()->route('profile')->with('status', 'Password berhasil diubah.');
    }


}
