<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Processa o login do usuário
    public function login(Request $request)
    {
        // Validação dos dados do formulário
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentativa de autenticação
        if (Auth::attempt($credentials)) {
            // Redireciona para a página inicial se a autenticação for bem-sucedida
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // Redireciona de volta para o formulário de login com uma mensagem de erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    // Processa o logout do usuário
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}