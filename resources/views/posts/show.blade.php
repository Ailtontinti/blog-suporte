@extends('layouts.layout')
@section('title', 'Postagem')

@section('content')
    <div class="card shadow-sm p-4">
        <h1 class="text-center">{{ $post->title }}</h1>
        @if ($post->media)
            @if (Str::endsWith($post->media, ['.jpg', '.png', '.jpeg', '.gif']))
                <img src="{{ asset('storage/' . $post->media) }}" class="img-fluid rounded mx-auto d-block mb-3" style="max-height: 600px; width: auto;">
            @elseif (Str::endsWith($post->media, ['.mp4', '.mov', '.avi']))
                <video class="img-fluid rounded mx-auto d-block mb-3" controls style="max-height: 600px; width: 100%;">
                    <source src="{{ asset('storage/' . $post->media) }}">
                </video>
            @endif
        @endif

        <h4 class="text-center">{{ $post->category }}</h4>
        <p class="text-muted text-center">{{ $post->created_at->format('d/m/Y') }}</p>
        <p class="text-muted">Postado em 13 de Março de 2025 por Ailton</p>
        <p>{!! $post->content !!}</p>

        @if ($post->sections && $post->sections->count() > 0)
            <div class="mt-4">
                <h4>Seções:</h4>
                @foreach ($post->sections as $section)
                    <div class="mb-3">
                        @if ($section->type === 'text')
                            <p>{!! $section->content !!}</p>
                        @elseif ($section->type === 'media')
                            @if (Str::startsWith($section->content, 'http'))
                                @if (Str::endsWith($section->content, ['.jpg', '.png', '.jpeg', '.gif', '.webp']))
                                    <img src="{{ $section->content }}" class="img-fluid rounded mb-3" style="max-width: 100%; height: auto;">
                                @elseif (Str::endsWith($section->content, ['.mp4', '.mov', '.avi', '.webm']))
                                    <video class="img-fluid rounded mb-3" controls style="max-width: 100%; height: auto;">
                                        <source src="{{ $section->content }}">
                                    </video>
                                @endif
                            @else
                                @if (Str::endsWith($section->content, ['.jpg', '.png', '.jpeg', '.gif', '.webp']))
                                    <img src="{{ asset('storage/posts' . $section->content) }}" class="img-fluid rounded mb-3" style="max-width: 100%; height: auto;">
                                @elseif (Str::endsWith($section->content, ['.mp4', '.mov', '.avi', '.webm']))
                                    <video class="img-fluid rounded mb-3" controls style="max-width: 100%; height: auto;">
                                        <source src="{{ asset('storage/posts' . $section->content) }}">
                                    </video>
                                @endif
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4 text-center">
            @auth
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Editar</a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                </form>
            @endauth

            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@endsection