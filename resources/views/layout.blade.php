<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Tutoriais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .banner {
            background: linear-gradient(135deg,rgb(63, 135, 199),rgb(4, 84, 204));
            color: white;
            padding: 10px 0;
            text-align: center;
            position: relative;
        }

        .banner img {
            width: 100%;
            height: auto;
            opacity: 0.7;
        }

        .banner h1, .banner p {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin: 0;
        }

        .footer {
            background: #293748;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 40px;
        }

        .highlight-post {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 45px;">
        Blog suporte CenterSis
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Sobre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contato</a>
            </li>
        </ul>
        <!-- Barra de Pesquisa -->
        <form class="d-flex" action="#" method="get">
            <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
    </div>
</nav>

    <!-- Banner -->
    <div class="banner">
        <img src="{{ asset('banner.jpg') }}" alt="Banner Image" style="height: 350px;">
        <!-- <h1 class="d-flex">Blog de Suporte</h1>
        <p>Saiba o que a CenterSis pode fazer por você!</p> -->
    </div>

    <div class="container-fluid mt-4">
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
                        <p>{{ Str::limit($latestPost->content, 150) }}</p>
                        <a href="{{ route('posts.show', $latestPost->id) }}" class="btn btn-primary">Leia mais</a>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Blog .</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

