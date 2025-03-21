@extends('layout')

@section('content')
    <h1 class="text-center mb-4">Blog de Suporte</h1>
    
    <div class="text-center mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Criar Novo Post</a>
    </div>

    @if ($posts->count() > 0)
        <div class="row">
            <!-- Contêiner Principal -->
            <div class="col-md-9">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-6">
                            <div class="card mb-4 shadow-sm">
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

                                    <div class="mt-3">
                                        <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Ver mais</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
            <!-- Contêiner de Últimos Posts -->
            <div class="col-md-3">
                <div class="recent-posts">
                    <h3>Últimos Posts</h3>
                    <ul>
                        @foreach($recentPosts as $post)
                            <li>
                                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @else
        <p class="text-center">Nenhum post encontrado.</p>
    @endif
@endsection

