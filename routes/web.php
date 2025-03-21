<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Rota para a página inicial
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rota para a página "Sobre"
Route::get('/sobre', function () {
    return view('sobre');
})->name('sobre');

// Rota para exibir um post específico
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// Rota para o controlador de posts, gerando as rotas RESTful
Route::resource('posts', PostController::class);

// Rota para excluir um post com o método DELETE
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Rotas de autenticação
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rotas de registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);