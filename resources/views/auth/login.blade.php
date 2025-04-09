@extends('layouts.Auth')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <!-- Logo -->
        <img src="{{ asset('images/logo_2.png') }}" alt="Logo" class="img-fluid mb-3" style="width: 150px; height: auto;">

        <h1 class="text-center">Entrar</h1>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3 text-start">
                <input type="email" name="email" class="form-control " placeholder="E-mail" required autofocus>
            </div>

            <div class="mb-3 text-start">
                <input type="password" name="password" class="form-control " placeholder="Senha" required>
                <div class="input-group-append">
                </div>
                <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Lembrar de mim
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        
                        </div>
                    </div>
                      <p class="mb-1">
                <a href="{{ route('register') }}">Esqueceu sua senha?</a>
                     </p>
        </form>
    </div>
@endsection
