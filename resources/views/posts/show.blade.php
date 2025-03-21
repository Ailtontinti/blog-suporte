@extends('layout')

@section('content')
    <div class="card shadow-sm p-4">
        @if ($post->media)
            @if (Str::endsWith($post->media, ['.jpg', '.png', '.jpeg', '.gif']))
                <img src="{{ asset('storage/' . $post->media) }}" class="img-fluid rounded mx-auto d-block mb-3" style="height: 300px;">
            @elseif (Str::endsWith($post->media, ['.mp4', '.mov', '.avi']))
                <video class="img-fluid rounded mx-auto d-block mb-3" controls>
                    <source src="{{ asset('storage/' . $post->media) }}">
                </video>
            @endif
        @endif

        <h2 class="text-center">{{ $post->title }}</h1>
        <p class="text-muted text-center">{{ $post->created_at->format('d/m/Y') }}</p>
        <p>{{ $post->content }}</p>

        <div class="mt-4 text-center">
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Editar</a>

            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
            </form>

            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@endsection
