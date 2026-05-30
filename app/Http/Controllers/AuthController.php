<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Exibe o formulário de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Realiza o login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('agendamentos.index');
        }

        return back()->withErrors(['email' => 'E-mail ou senha incorretos.']);
    }

    // Exibe o formulário de cadastro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Realiza o cadastro
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'admin'    => false,
        ]);

        Auth::login($user);

        return redirect()->route('agendamentos.index')
            ->with('success', 'Cadastro realizado com sucesso!');
    }

    // Realiza o logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
