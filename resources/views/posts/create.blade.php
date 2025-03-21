@extends('layout')

@section('content')
    <div class="card p-4 shadow-sm">
        <h1 class="text-center">Criar Post</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Título:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mídia:</label>
                <input type="file" name="media" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Conteúdo:</label>
                <textarea name="content" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-success w-100">Publicar</button>
        </form>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
