@extends('layout')

@section('content')
    <div class="card p-4 shadow-sm">
        <h1 class="text-center">Editar Post</h1>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Título:</label>
                <input type="text" name="title" value="{{ $post->title }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Conteúdo:</label>
                <textarea name="content" class="form-control" rows="4" required>{{ $post->content }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Mídia Atual:</label>
                <div>
                    @if ($post->media)
                        @if (Str::endsWith($post->media, ['.jpg', '.png', '.jpeg', '.gif']))
                            <img src="{{ asset('storage/' . $post->media) }}" class="img-fluid rounded">
                        @elseif (Str::endsWith($post->media, ['.mp4', '.mov', '.avi']))
                            <video class="img-fluid rounded" controls>
                                <source src="{{ asset('storage/' . $post->media) }}">
                            </video>
                        @endif
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Substituir Mídia:</label>
                <input type="file" name="media" class="form-control">
            </div>

            <button type="submit" class="btn btn-warning w-100">Atualizar</button>
        </form>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
