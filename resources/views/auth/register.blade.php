@extends('layouts.auth')

@section('content')
    <div class="card p-4 shadow-sm">
        <h1 class="text-center">Cadastrar</h1>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <input type="text" name="name" class="form-control " placeholder="Nome" required autofocus>
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control " placeholder="E-mail" required autofocus>
                
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Senha" required autofocus>
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Senha" required autofocus>
            </div>

            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        </form>
    </div>
@endsection