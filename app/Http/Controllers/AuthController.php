<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nim' => ['required'],
            'password' => ['required'],
        ]);

        // Cek apakah NIM ada di database
        $user = User::where('nim', $credentials['nim'])->first();

        if (!$user) {
            // Jika NIM tidak ditemukan
            return back()->withErrors([
                'nim' => 'NIM tidak ditemukan.',
            ]);
        }

        // Jika NIM ditemukan, cek password
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ]);
        }

        // Login berhasil
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna

        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect('/login'); // Mengarahkan kembali ke halaman login
    }

    public function index()
    {
        // Cek role sebelum menampilkan view
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        $users = User::all(); // atau User::paginate(10)
        return view('admin.kelola', compact('users'));
    }
}
