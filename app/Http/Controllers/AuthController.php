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
        return view('auth.login');
    }
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->role === 'hr') {
            return redirect('/dashboard');
        } elseif ($user->role === 'jobseeker') {
            return redirect('/about');
        } else {
            return redirect('/');
        }
    }
    return back()->withErrors([
        'email' => 'Email atau password salah.'
    ]);
}

    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
{
    $request->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'role'     => 'required|in:hr,jobseeker'
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
