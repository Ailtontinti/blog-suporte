@extends('layout')

@section('content')
    <div class="card p-4 shadow-sm">
        <h1 class="text-center">Adicionar Post</h1>

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
                <label class="form-label">Categoria:</label>
                <select name="category" class="form-select" required>
                    <option value="Novidades do Sistema">Novidades do Sistema</option>
                    <option value="Tutoriais e Dicas">Tutoriais e Dicas</option>
                    <option value="Processos Maçônicos">Processos Maçônicos</option>
                    <option value="Funcionalidades em Destaque" selected>Funcionalidades em Destaque</option>
                </select>
            </div>

            <div id="sections-container">
                <!-- Seção inicial de texto -->
                <div class="section mb-4 border p-3 position-relative">
                    <input type="hidden" name="sections[0][type]" value="text">
                    <label class="form-label">Texto:</label>
                    <textarea name="sections[0][content]" class="form-control" rows="5" required></textarea>
                    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeSection(this)">Remover seção</button>
                </div>
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-secondary me-2" onclick="addTextSection()">Adicionar Texto</button>
                <button type="button" class="btn btn-secondary" onclick="addMediaSection()">Adicionar Mídia</button>
            </div>

            <button type="submit" class="btn btn-primary w-100">Salvar</button>
        </form>
    </div>

    <script>
        let sectionIndex = 1;

        function addTextSection() {
            const container = document.getElementById('sections-container');
            const div = document.createElement('div');
            div.classList.add('section', 'mb-4', 'border', 'p-3', 'position-relative');
            div.innerHTML = `
                <input type="hidden" name="sections[${sectionIndex}][type]" value="text">
                <label class="form-label">Texto:</label>
                <textarea name="sections[${sectionIndex}][content]" class="form-control" rows="5" required></textarea>
                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeSection(this)">Remover seção</button>
            `;
            container.appendChild(div);
            sectionIndex++;
        }

        function addMediaSection() {
            const container = document.getElementById('sections-container');
            const div = document.createElement('div');
            div.classList.add('section', 'mb-4', 'border', 'p-3', 'position-relative');
            div.innerHTML = `
                <input type="hidden" name="sections[${sectionIndex}][type]" value="media">
                <label class="form-label">Arquivo de Mídia (imagem/vídeo):</label>
                <input type="file" name="sections[${sectionIndex}][file]" class="form-control" accept="image/*,video/*" required onchange="previewMedia(this)">
                <div class="preview mt-2"></div>
                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeSection(this)">Remover seção</button>
            `;
            container.appendChild(div);
            sectionIndex++;
        }

        function removeSection(button) {
            const section = button.closest('.section');
            section.remove();
        }

        function previewMedia(input) {
            const preview = input.nextElementSibling;
            preview.innerHTML = '';

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const url = URL.createObjectURL(file);

                if (file.type.startsWith('image/')) {
                    preview.innerHTML = `<img src="${url}" class="img-fluid mt-2" style="max-height: 200px;">`;
                } else if (file.type.startsWith('video/')) {
                    preview.innerHTML = `<video src="${url}" controls class="mt-2" style="max-height: 200px; width: 100%;"></video>`;
                }
            }
        }
    </script>
@endsection
