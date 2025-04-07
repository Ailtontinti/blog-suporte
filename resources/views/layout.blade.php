<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Tutoriais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">    

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 50px;">
                 Blog de dicas e Tutoriais
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sobre') }}">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sobre') }}">Contato</a>
                </li>
            </ul>
            <form class="d-flex ms-3" action="#" method="get">
                <input class="form-control me-2" type="search" placeholder="Pesquise..." aria-label="Buscar">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
            </form>
        </div>
    </div>
</nav>

<!-- Espaço para compensar a navbar fixa -->
<div style="height: 60px;"></div>

<!-- Banner -->
<div class="banner">
    <img src="{{ asset('banner.jpg') }}" alt="Banner Image">
    <div class="banner-text">
        <h1>Blog Suporte</h1>
        <p>Saiba o que a CenterSis pode fazer por você!</p>
    </div>
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Destaque para o último post -->
            @if(isset($latestPost))
                <div class="highlight-post">
                    @if ($latestPost->featured_image)
                        <img src="{{ asset('storage/' . $latestPost->featured_image) }}" class="img-fluid rounded mb-3">
                    @endif
                    <h2>{{ $latestPost->title }}</h2>
                    <p class="text-truncate" style="max-width: 100%;">{{ Str::limit($latestPost->content, 150) }}</p>
                    <a href="{{ route('posts.show', $latestPost->id) }}" class="btn btn-primary">Leia mais</a>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<!-- F<!-- Botão flutuante de engrenagem -->
<a href="{{ route('posts.create') }}" class="btn btn-light position-fixed bottom-0 end-0 m-4 shadow" style="z-index: 1000;">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
        <path d="M9.605 1.05a.5.5 0 0 1 .66.24l.336.866a5.522 5.522 0 0 1 1.263.732l.93-.232a.5.5 0 0 1 .607.607l-.232.93c.278.376.51.78.732 1.263l.866.336a.5.5 0 0 1 .24.66l-.5 1a.5.5 0 0 1-.66.24l-.866-.336a5.522 5.522 0 0 1-1.263.732l.232.93a.5.5 0 0 1-.607.607l-.93-.232a5.522 5.522 0 0 1-.732 1.263l.336.866a.5.5 0 0 1-.24.66l-1 .5a.5.5 0 0 1-.66-.24l-.336-.866a5.522 5.522 0 0 1-1.263-.732l-.93.232a.5.5 0 0 1-.607-.607l.232-.93a5.522 5.522 0 0 1-1.263-.732l-.866.336a.5.5 0 0 1-.66-.24l-.5-1a.5.5 0 0 1 .24-.66l.866-.336a5.522 5.522 0 0 1-.732-1.263l-.93.232a.5.5 0 0 1-.607-.607l.232-.93a5.522 5.522 0 0 1-.732-1.263l-.866-.336a.5.5 0 0 1-.24-.66l.5-1a.5.5 0 0 1 .66-.24l.866.336a5.522 5.522 0 0 1 1.263-.732l-.232-.93a.5.5 0 0 1 .607-.607l.93.232a5.522 5.522 0 0 1 .732-1.263l-.336-.866a.5.5 0 0 1 .24-.66l1-.5ZM8 11.5A3.5 3.5 0 1 0 8 4a3.5 3.5 0 0 0 0 7.5Z"/>
    </svg>
</a>
<a href="{{ route('posts.create') }}" class="btn btn-success">Ir para Criar Post</a>


<footer class="footer">
    <p>&copy; {{ date('Y') }} Blog .</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>