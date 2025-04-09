@extends('layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Todos os Posts</h1>

        @if ($posts->count() > 0)
            <!-- Post em destaque -->
            @php
                $highlightedPost = $posts->first();
            @endphp

            <div class="mb-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                        @if ($highlightedPost->media)
                            @if (Str::endsWith($highlightedPost->media, ['.jpg', '.png', '.jpeg', '.gif']))
                                <img src="{{ asset('storage/' . $highlightedPost->media) }}" class="img-fluid rounded mb-3">
                            @elseif (Str::endsWith($highlightedPost->media, ['.mp4', '.mov', '.avi']))
                                <video class="img-fluid rounded mb-3" controls>
                                    <source src="{{ asset('storage/' . $highlightedPost->media) }}">
                                </video>
                            @endif
                        @endif
                        <h2>{{ $highlightedPost->title }}</h2>
                        <p>{{ Str::limit($highlightedPost->content, 200) }}</p>
                        <a href="{{ route('posts.show', $highlightedPost) }}" class="btn btn-primary">Leia mais</a>
                    </div>
                </div>
            </div>

            <!-- Lista dos outros posts -->
            <div class="row">
                @foreach($posts->skip(1) as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                @if ($post->media)
                                    @if (Str::endsWith($post->media, ['.jpg', '.png', '.jpeg', '.gif']))
                                        <img src="{{ asset('storage/' . $post->media) }}" class="img-fluid rounded mb-3">
                                    @elseif (Str::endsWith($post->media, ['.mp4', '.mov', '.avi']))
                                        <video class="img-fluid rounded mb-3" controls>
                                            <source src="{{ asset('storage/' . $post->media) }}">
                                        </video>
                                    @endif
                                @endif
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Leia mais</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p class="text-center">Nenhum post encontrado.</p>
        @endif
    </div>

    <!-- Rodapé com botão de login -->
    <footer class="mt-5 text-center">
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary">Fazer Login</a>
            <a href="{{ route('posts.create') }}">Criar Post</a>
        @endguest
    </footer>
@endsection
