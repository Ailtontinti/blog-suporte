<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Rota para a página inicial
Route::get('/', [PostController::class, 'index'])->name('home');

// Rota para a página "Sobre"
Route::get('/sobre', function () {
    return view('sobre'); // View: resources/views/sobre.blade.php
})->name('sobre');


// Rota para o formulário de criação de posts
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // View: resources/views/posts/create.blade.php

// Rota para o formulário de edição de posts
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit'); // View: resources/views/posts/edit.blade.php

// Rota para exibir um post específico
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // View: resources/views/posts/show.blade.php


// Rota para o controlador de posts, gerando as rotas RESTful
Route::resource('posts', PostController::class)->except(['create', 'edit']); // Evita duplicar as rotas de criação e edição

// Rotas de autenticação
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login'); // View: resources/views/auth/login.blade.php
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rotas de registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register'); // View: resources/views/auth/register.blade.php
Route::post('register', [RegisterController::class, 'register']);