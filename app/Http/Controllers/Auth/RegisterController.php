<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Exibe o formulário de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Processa o registro do usuário
    public function register(Request $request)
    {
        // Validação dos dados do formulário
        $this->validator($request->all())->validate();

        // Criação do novo usuário
        $user = $this->create($request->all());

        // Autentica o usuário
        Auth::login($user);

        // Redireciona para a página inicial
        return redirect('/');
    }

    // Valida os dados do formulário
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Cria um novo usuário
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}