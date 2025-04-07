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
                            <img src="{{ asset('storage/' . $post->media) }}" class="img-fluid rounded mx-auto d-block mb-3" style="height: 600px;">
                        @elseif (Str::endsWith($post->media, ['.mp4', '.mov', '.avi']))
                            <video class="img-fluid rounded mx-auto d-block mb-3" controls>
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

            <div class="mb-3">
                <label class="form-label">Seções:</label>
                <div>
                    @if ($post->sections && $post->sections->count() > 0)
                        @foreach ($post->sections as $section)
                            <div class="mb-3">
                                <label class="form-label">Seção:</label>
                                @if ($section->type === 'text')
                                    <input type="text" name="sections[{{ $section->id }}][content]" value="{{ $section->content }}" class="form-control">
                                @elseif ($section->type === 'image')
                                    <img src="{{ asset('storage/' . $section->content) }}" class="img-fluid rounded mb-3">
                                    <input type="file" name="sections[{{ $section->id }}][file]" class="form-control">
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p>Nenhuma seção encontrada.</p>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Adicionar Seção:</label>
                <select name="new_section_type" class="form-control mb-2">
                    <option value="text">Texto</option>
                    <option value="image">Imagem</option>
                </select>
                <input type="text" name="new_section_content" class="form-control mb-2" placeholder="Conteúdo da seção (para texto)">
                <input type="file" name="new_section_file" class="form-control" placeholder="Upload de imagem (para imagem)">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <div class="card shadow-sm p-4">
        @if ($post->media)
            @if (Str::endsWith($post->media, ['.jpg', '.png', '.jpeg', '.gif']))
                <img src="{{ asset('storage/' . $post->media) }}" class="img-fluid rounded mx-auto d-block mb-3" style="height: 600px;">
            @elseif (Str::endsWith($post->media, ['.mp4', '.mov', '.avi']))
                <video class="img-fluid rounded mx-auto d-block mb-3" controls>
                    <source src="{{ asset('storage/' . $post->media) }}">
                </video>
            @endif
        @endif

        <h2 class="text-center">{{ $post->title }}</h2>
        <p class="text-muted text-center">{{ $post->created_at->format('d/m/Y') }}</p>
        <p>{{ $post->content }}</p>

        <!-- Exibição das seções -->
        @if ($post->sections && $post->sections->count() > 0)
            <div class="mt-4">
                <h4>Seções:</h4>
                @foreach ($post->sections as $section)
                    <div class="mb-3">
                        @if ($section->type === 'text')
                            <p>{{ $section->content }}</p>
                        @elseif ($section->type === 'image' && $section->content)
                            <img src="{{ asset('storage/' . $section->content) }}" class="img-fluid rounded mb-3">
                        @elseif ($section->type === 'video' && $section->content)
                            <video class="img-fluid rounded mb-3" controls>
                                <source src="{{ asset('storage/' . $section->content) }}">
                            </video>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

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
